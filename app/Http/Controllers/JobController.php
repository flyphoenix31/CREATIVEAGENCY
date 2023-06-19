<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\JobRepository;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use Spatie\Permission\Models\Role;


class JobController extends Controller
{
    public function __construct(JobRepository $jobservice)
    {
        $this->jobservice = $jobservice;
    }

    //Admin List
	public function list(Request $request)
    {
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'jobList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'job.manager.list';

        if ($request->ajax())
        {
            $result = $this->jobservice->getRecords($request);

            return view('portal.job.manager.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);

		return view('portal',compact('page', 'attri', 'result'));
    }

    //User Job List
    public function jobList (Request $request)
    {
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'jobCards',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'job.designer.jobcard';

        if ($request->ajax())
        {
            //$result = $this->jobservice->getRecords($request);

            //return view('portal.job.partial.manager.ajaxlist',  compact('result'))->render();
        }

        $categories = $this->jobservice->getCategories();
        $result = $this->jobservice->paginateRecords($request);

		return view('portal',compact('page', 'attri', 'result', 'categories'));
    }

    //User Active Job List
    public function activeJobList(Request $request)
    {
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'activeJobs',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'job.designer.activejob.list';

        if ($request->ajax())
        {
            $result = $this->jobservice->paginateActiveJobRecords($request);

            return view('portal.job.designer.activejob.micro.ajaxlist',  compact('result'))->render();
        }

        $categories = $this->jobservice->getCategories();

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result', 'categories'));
    }

    //User Job History List
    public function jobHistory(Request $request)
    {

        $result = $this->jobservice->paginateJobHistoryRecords($request);

        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'jobHistory',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'job.designer.history.list';

        if ($request->ajax())
        {
            $result = $this->jobservice->paginateJobHistoryRecords($request);

            return view('portal.job.designer.history.micro.ajaxlist',  compact('result'))->render();
        }

        $categories = $this->jobservice->getCategories();

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result', 'categories'));
    }




    public function searchJob (Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->jobservice->paginateRecords($request);
            //dd($result);
            $render   = view('portal.job.designer.micro.card',  compact('result'))->render();

		    return response()->json(['success' => true,'records'=>$render]);

        }
    }



    public function show(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->jobservice->getRecord($id);
		$render   = view('portal.audit.manager.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function view($slug)
    {
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'view_job',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = $this->jobservice->getRecordBySlug($slug);


        $page        = 'job.manager.view';

        if( \Auth::user()->hasRole('designer') )
        {
            $page  = 'job.designer.viewjob';
        }


        //Check this issue

       /*  if ($user->isDesigner == TRUE)
        {
            $page        = 'job.designer.viewjob';
        }

        */


        return view('portal', compact('page', 'result', 'attri'));
    }

    public function create(Request $request)
    {
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'create_job',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $categories = $this->jobservice->getCategories();

        $result      = collect([]);
        $page        = 'job.manager.create';

        $roles    = Role::where('name', 'designer')->pluck('name', 'id');

        $users = \App\Models\User::active()->isrole(['designer'])->pluck('name','id');

        return view('portal', compact('page', 'result', 'attri', 'categories', 'roles', 'users'));
    }



    public function store(StoreJobRequest $request)
    {
        $record = $this->jobservice->storeRecord($request);

        if ($record)
        {
            $url = $record->slugurl;
            return response()->json(['success' => true, 'url' => $url ]);
        }

        return response()->json(['success' => false ]);
    }


    public function update(UpdateJobRequest $request)
    {
        $record = $this->jobservice->updateRecord($request);

        if ($record)
        {
            $id = decryptId($request->id);

            $url = $record->slugurl;

            return response()->json(['success' => true, 'url' => $url ]);
        }

        return response()->json(['success' => false]);
    }

    public function edit($slug)
    {
        $page   = 'job.manager.edit';
        $record = $this->jobservice->getRecordBySlugWithDistribution($slug);
        $attri  = [
            'category_name'    => 'jobs',
            'page_name'        => 'edit_jobs',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $roles    = Role::where('name', 'designer')->pluck('name','id');

        $users = \App\Models\User::active()->isrole(['designer'])->pluck('name','id');

        $categories = $this->jobservice->getCategories();


        //dd($record->distributionlist);


        $selUsers = [];

        if ($record->type_id == 2)
        {
            foreach($record->distributionlist as $selu)
            {
               $selUsers[] = $selu->user_id;
            }
        }








        //dd($record->categories, $categories);

        $selCat = [];

        foreach($record->categories as $selc)
        {
           $selCat[] = $selc->category_id;
        }

        //dd($selCat);


        //dd($record->categories);

        return view('portal', compact('page', 'record', 'attri', 'users', 'roles', 'categories', 'selCat', 'selUsers'));
    }

    public function acceptJob(Request $request)
    {
        $id = decryptid($request->id);
        $record = $this->jobservice->checkIsAccepted($id);

        if (!$record)
        {
            //Check Job Status

            if($this->jobservice->checkIsActive($id) == 1)
            {
                $record = $this->jobservice->acceptJob($id, \Auth::id());

                $render = $this->jobservice->renderJobAction($record->job_id);

                return response()->json(['success' => true, 'render' => $render ]);
            }

            return response()->json(['success' => false, 'message' => 'sorry! Job already closed.' ]);

        }

        return response()->json(['success' => false, 'message' => 'sorry! Its already accepted by others.' ]);

    }


    public function rejectJob(Request $request)
    {
        $id = decryptid($request->id);

        $record = $this->jobservice->rejectJob($id, \Auth::id());

        $render = $this->jobservice->renderJobAction($record->job_id);

        return response()->json(['success' => true, 'render' => $render ]);

    }

    public function close(Request $request)
    {
        $id     = decryptid($request->id);
        $record = $this->jobservice->CloseJobAd($id);

        if ($record)
        {

            $render = $this->jobservice->renderJobAction($id);

            return response()->json(['success' => true, 'render' => $render ]);
        }

        return response()->json(['success' => false, 'message' => 'sorry! You cant close the ad now.' ]);

    }







}
