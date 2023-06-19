<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Traits\FileUploadTrait;

class ContactRepository
{
    use FileUploadTrait;

    public function PaginateRecordsWithFilter($request)
    {
    	$records = Contact::Filter($request);

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));

    	return $records;
    }

    public function getRecord($id)
    {
        return Contact::IsID($id)->first();
    }

    public function getLatestContactCount($day = 10)
    {
        return Contact::whereDate('created_at', '>=' , \Carbon\Carbon::now()->subDays($day))->count();
    }

    public function updateRecord($request)
    {
        $id = decryptId($request->id);

        $model = new Contact();

        $insdata = $request->only($model->getFillable());

        $record = Contact::find($id);

        if (!$record)
        {
            return FALSE;
        }

        $record->update($insdata);

        if($request->hasFile('contact_image') )
        {
            $this->saveFile($record, 'contact_image', 'contactimage');
        }

        addUserActivity('Contact',  'Updated the Contact Details', $record);

        return TRUE;

    }

    public function storeRecord($request)
    {
        $model = new Contact();

        $insdata = $request->only($model->getFillable());
        $insdata['status_id'] = 1;

        $record = Contact::create($insdata);

        if($request->hasFile('contact_image') )
        {
            $this->saveFile($record, 'contact_image', 'contactimage');
        }


        addUserActivity('Contact',  'Created a new Contact', $record);

        return $record->id;

    }

    public function deleteRecord($id)
    {
        Contact::destroy($id);

        addUserActivity('Contact',  'Destroyed Contact', $record);
    }

    public function renderRecord($id)
    {
        $result   = Contact::where('id', $id)->first();
        $render   = view('portal.contact.partial.render_edit',  compact('result'))->render();
        return $render;
    }

    public function renderRow($id)
    {
        $result   = Contact::where('id', $id)->get();
        $render   = view('portal.contact.partial.render_data',  compact('result'))->render();
        return $render;
    }


}
