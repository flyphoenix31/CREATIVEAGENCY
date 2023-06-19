<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Mail\MailAccount;
use Carbon\Carbon;
use App\Models\Mail\MailErrorTracker;
use App\Models\Mail\MailDailyCount;

class MailRepository
{

    protected $file;
    protected $folder;
    protected $record;

    public function renderRow($id)
    {
        $result   = MailAccount::where('id', $id)->get();
        $render   = view('portal.mail.partial.render_data',  compact('result'))->render();
        return $render;
    }

    public function getRecord($id)
    {
        return MailAccount::IsID($id)->first();
    }

    public function getRecords($request)
    {
        return MailAccount::paginate(\config('pm.cmspagination'));
    }

    public function ChangeMailAccount(Request $request)
    {
        $id    = \Crypt::decryptString($request->id);

        MailAccount::where('is_default', 1)->update(['is_default' => NULL]);

        MailAccount::where('id', $id)->update(['is_default' => 1]);

        return TRUE;
    }

    public function storeRecord($request)
    {
        $model = new MailAccount();

        $insdata = $request->only($model->getFillable());
        $insdata['status_id'] = 1;

        $record = MailAccount::create($insdata);

        return $record->id;
    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);

        $model = new MailAccount();

        $insdata = $request->only($model->getFillable());

        $record = MailAccount::find($id);

        if (!$record)
        {
            return FALSE;
        }

        $record->update($insdata);

        return TRUE;
    }

    public function deleteRecord($id)
    {
        MailAccount::destroy($id);
    }


    public function DailyLimit(Request $request)
    {
        $result = MailDailyCount::selectRaw('*, sum(success_count) as success_count, sum(failure_count) as failure_count')->groupby('send_date')->where('send_date','>=',\Carbon\Carbon::today()->subDays(15))->paginate(\config('pm.cmspagination'));

        return $result;
    }

    public function MailErrorList(Request $request)
    {
        $result = MailErrorTracker::with('user')->filter($request)
               // ->whereDate('created_at', '>=' ,$start_date)
                //->whereDate('created_at', '<=' ,$end_date)
                ->paginate(\config('pm.cmspagination'));

        return $result;
    }



}
