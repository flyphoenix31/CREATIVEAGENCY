<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Traits\FileUploadTrait;

class DomainRepository
{
    use FileUploadTrait;

    public function PaginateRecordsWithFilter($request)
    {
    	$records = Domain::Filter($request);

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));

    	return $records;
    }

    public function getRecord($id)
    {
        return Domain::IsID($id)->first();
    }

    public function getLatestContactCount($day = 10)
    {
        return Domain::whereDate('created_at', '>=' , \Carbon\Carbon::now()->subDays($day))->count();
    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);

        $model = new Domain();

        $insdata = $request->only($model->getFillable());

        $record = Domain::find($id);

        if (!$record)
        {
            return FALSE;
        }

        $record->update($insdata);

        if($request->hasFile('contact_image') )
        {
            $this->saveFile($record, 'contact_image', 'contactimage');
        }

        addUserActivity('Domain',  'Updated the Domain Details', $record);

        return TRUE;

    }

    public function storeRecord($request)
    {
        $model = new Domain();

        $insdata = $request->only($model->getFillable());
        $insdata['status_id'] = 1;

        $record = Domain::create($insdata);

        if($request->hasFile('contact_image') )
        {
            $this->saveFile($record, 'contact_image', 'contactimage');
        }


        addUserActivity('Domain',  'Created a new Domain', $record);

        return $record->id;

    }

    public function deleteRecord($id)
    {
        $record = Domain::find($id);
        //Domain::destroy($id);

        addUserActivity('Domain',  'Destroyed Domain', $record);
    }

    public function renderRecord($id)
    {
        $result   = Domain::where('id', $id)->first();
        $render   = view('portal.domain.partial.render_edit',  compact('result'))->render();
        return $render;
    }

    public function renderRow($id)
    {
        $result   = Domain::where('id', $id)->get();
        $render   = view('portal.domain.partial.render_data',  compact('result'))->render();
        return $render;
    }


}
