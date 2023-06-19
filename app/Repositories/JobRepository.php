<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Job\Job;
use App\Models\Job\Category;
use App\Models\Job\JobCategory;
use App\Models\Job\JobDistribution;
use App\Models\Job\JobUser;
use App\Models\Job\JobRejected;

class JobRepository
{
    public $record;

    public function renderRow($id = NULL)
    {
        $result   = $this->record;

        if (!$result)
        {
            $result   = Contact::where('id', $id)->get();
        }

        $render   = view('portal.job.manager.partial.render_data',  compact('result'))->render();

        return $render;
    }

    public function closeAd($id = null)
    {
        $record = $this->record;
        if($record)
        {
            $record->status_id = 3;
            $record->save();

            return TRUE;
        }

        return FALSE;
    }

    public function CloseJobAd($id)
    {
        $record = $this->getRawRecord($id);

        $this->record = $record;

        return $this->closeAd();
    }

    public function getRawRecord($id)
    {
        return Job::isId($id)->checkUserAccess()->first();
    }

    public function checkIsActive($id)
    {
        $record = Job::isId($id)->checkUserAccess()->Active()->first();

        if ($record)
        {
            return TRUE;
        }

        return FALSE;
    }

    public function getRecord($id)
    {
        return Job::with('categories', 'active_jobuser')->isId($id)->checkUserAccess()->first();
    }

    public function getRecordBySlug($slug)
    {
        $userId = \Auth::id();

        //\DB::connection()->enableQueryLog();

        $record = Job::with(['categories', 'active_jobuser', 'active_jobuser.user', 'rejected' => function($query) use($userId)
        {
            $query->where('user_id', $userId);
        }])->isSlug($slug)->checkUserAccess()->first();

       // dd(\DB::getQueryLog());

        return $record;
    }

    public function getRecordBySlugWithDistribution($slug)
    {
        $userId = \Auth::id();

        $record = Job::with(['categories', 'active_jobuser', 'active_jobuser.user', 'distributionlist','rejected' => function($query) use($userId)
        {
            $query->where('user_id', $userId);
        }])->isSlug($slug)->checkUserAccess()->first();

        return $record;
    }




    public function getCategories($ids = [])
    {
        return Category::pluck('name','id');
    }

    public function checkIsAccepted($id)
    {
        $accepted = JobUser::where('job_id', $id)->active()->count();

        if ($accepted > 0)
        {
            return TRUE;
        }

        return FALSE;

    }

    public function acceptJob($id, $userId)
    {
        $record = JobUser::create(['user_id' => $userId, 'job_id' => $id, 'status_id' => 1]);

        return $record;
    }

    public function rejectJob($id, $userId)
    {
        $job = $record = $this->getRawRecord($id);

        $record = JobRejected::firstOrCreate(['user_id' => $userId, 'job_id' => $id]);

        return $record;
    }



    public function renderJobAction($id)
    {
        $result = Job::with('categories')->isId($id)->first();

        $page   = 'portal.job.manager.partial.jobaction';

        if( \Auth::user()->hasRole('designer') )
        {
            $page  = 'portal.job.designer.micro.action';
        }

        $render   = view($page,  compact('result'))->render();

        return $render;
    }


    public function paginateActiveJobRecords($request)
    {
        $result = Job::latest()
                ->isKeywords($request->keywords)
                ->isCategory($request->category_id)
                ->jobTypes($request->job_type)
                ->CheckUserAccess()
                ->Active()->wherehas('active_jobuser');

        $result = $result->paginate(\config('pm.cmspagination'));

        return $result;
    }

    public function paginateJobHistoryRecords($request)
    {
        $result = Job::latest()
                ->isKeywords($request->keywords)
                ->isCategory($request->category_id)
                ->jobTypes($request->job_type)
                ->CheckUserAccess()
                ->NotActive()->wherehas('active_jobuser_history');

        $result = $result->paginate(\config('pm.cmspagination'));

        return $result;
    }









    public function paginateRecords($request)
    {
        $result = Job::latest()
                ->isKeywords($request->keywords)
                ->isCategory($request->category_id)
                ->jobTypes($request->job_type)
                ->postDate($request->date_posted)
                ->budget($request->min_budget, $request->max_budget);

        $result = $result->paginate(\config('pm.cmspagination'));

        return $result;
    }


    public function getRecords($request)
    {
        return Job::latest()->paginate(\config('pm.cmspagination'));
    }

    public function storeRecord($request)
    {
        $model = new Job();

        $insdata = $request->only($model->getFillable());

        $insdata['status_id'] = 1;

        $record = Job::create($insdata);

        addUserActivity('Contact',  'Created a new Job', $record);

        $this->addCategory($record, $request->category_id);

        $this->addUsersOrRole($record, $request->users, $request->role_id);


        $this->record = $record;

        return $record;

    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);

        $record = Job::findorfail($id);

        $model = new Job();

        $insdata = $request->only($model->getFillable());

        $record->update($insdata);

        addUserActivity('Contact',  'Updated Job #'.$record->slug, $record);

        $this->updateCategory($record, $request->category_id);

        $this->updateDistributionList($record, $request->users, $request->role_id);


        $this->record = $record;

        return $record;

    }

    public function updateDistributionList($record, $users = null, $role = null)
    {
        if ($record->type_id == 2)
        {
            $this->updateUserDistribution($record->id,$users);
        }
        return TRUE;
    }

    public function updateUserDistribution($recordId, $users)
    {
        //delete the users who not in the new list
        JobDistribution::where('job_id', $recordId)->whereNotIn('user_id', $users)->delete();

        foreach($users as $userId)
        {
            $user = JobDistribution::firstOrCreate([
                'job_id'  => $recordId,
                'user_id' => $userId
            ], [
                'job_id'  => $recordId,
                'user_id' => $userId
            ]);
        }

        return TRUE;
    }

    public function addUsersOrRole($record, $users = null, $role = null)
    {
        $insdata    = [];

        if ($role)
        {
            $record->type_id = 1;
            $record->save();
            JobDistribution::create(['job_id' => $record->id, 'role_id'=> $role]);
        }
        else
        {
            if($users)
            {
                foreach ($users as $userId)
                {
                    $insdata[] = ['job_id' => $record->id, 'user_id' => $userId];
                }

                $record->type_id = 2;
                $record->save();

                JobDistribution::insert($insdata);
            }
        }

        //Add Notification Queue
        $exitCode = \Artisan::queue('notification:create', ['type'=> 'storeJob', 'id' => $record->id]);

        return TRUE;
    }

    public function addCategory($record, $tags)
    {
        $insdata    = [];

        if($tags)
        {
            foreach ($tags as $tag)
            {
                $insdata[] = ['job_id' => $record->id, 'category_id' => $tag];
            }

            JobCategory::insert($insdata);

        }

        return TRUE;
    }

    public function updateCategory($id, $tags)
    {
        $insdata    = [];
        $categories = JobCategory::where('job_id', $id)->delete();

        foreach ($tags as $tag)
        {
            $insdata[] = ['job_id' => $id, 'category_id' => $tag];
        }

        JobCategory::insert($insdata);

        return TRUE;
    }



}
