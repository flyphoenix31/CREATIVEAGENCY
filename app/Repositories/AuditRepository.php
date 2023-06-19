<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class AuditRepository
{

    public function renderRow($id)
    {
        $result   = MailAccount::where('id', $id)->get();
        $render   = view('portal.mail.partial.render_data',  compact('result'))->render();
        return $render;
    }

    public function getRecord($id)
    {
        return Activity::find($id);
    }

    public function getRecords($request)
    {
        return Activity::latest()->paginate(\config('pm.cmspagination'));
    }

}
