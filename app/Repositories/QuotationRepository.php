<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Items;
use App\Models\Invoice\Bank;
use App\Models\Invoice\MailQuotation;
use App\Traits\FileUploadTrait;

class QuotationRepository
{
    use FileUploadTrait;

    public $quotation;

    public function getLatestQuotations($item = 10)
    {
    	$records = MailQuotation::with('invoice','user');

    	$records = $records->latest()->limit($item)->get();
    	return $records;
    }

    public function quotationWithFilter($request)
    {
    	$records = MailQuotation::with('invoice', 'user')->Filter($request);

    	$records = $records->latest()->paginate(\config('pm.cmspagination'));
    	return $records;
    }

    public function storeRecord($request)
    {
        $model = new MailQuotation();

        $insdata = $request->only($model->getFillable());
        $insdata['status_id'] = 1;

        $record = MailQuotation::create($insdata);

        if($request->filled('invoice_number') )
        {
            //add invoice ID
            $invoice = Invoice::where('invoice_number', $request->invoice_number)->first();

            if ($invoice)
            {
                $record->invoice_id   = $invoice->id ;
            }
        }

        $record->user_id     = \Auth::id();
        $record->status_id   = 1;
        $record->view_count  = 0;
        $record->save();

        addUserActivity('Quotation',  'Created a Quotation');

        return $record->id;

    }

    public function getInvoiceRecord()
    {
        return $this->quotation;
    }

    public function changeToViewed()
    {
        $this->quotation->status_id = 3;
        $this->quotation->save();

        return $this;
    }

    public function findRecord($invoiceId)
    {
        $quotation = Invoice::find($invoiceId);
        $this->quotation = $quotation;
        return $this;
    }

    public function saveQuotationMail($request, $invoiceId)
    {
        $model   = new MailQuotation();

        $request->merge([ 'invoice_id' => $invoiceId ]);

        $insdata = $request->only($model->getFillable());

        $record  = MailQuotation::create($insdata);

        $record->user_id     = \Auth::id();
        $record->public_link = unique_random($model->getTable(), 'public_link', 6);
        $record->status_id   = 1;
        $record->view_count  = 0;
        $record->save();

        $this->quotation = $record;
        return $this;
    }

    public function getSharableLink($id = NULL)
    {
        if ($id)
        {
            $record = MailQuotation::find($id);
        }
        else
        {
            $record = $this->quotation;
        }

        return $record->public_link;
    }

    public function getQuotation($code)
    {
        $record = MailQuotation::where('public_link', $code)->Active()->first();

        if (!$record)
        {
            abort(404);
        }
        $this->quotation = $record;
        return $this;
    }

    public function GetQuotationStatus($id)
    {
        $result   = MailQuotation::with('user')->where('id', $id)->first();

        return view('portal.quotation.partial.render_status',  compact('result'))->render();
    }

    public function updateQuotationStatus($id, $status)
    {
        $result   = MailQuotation::with('user')->where('id', $id)->first();

        if ($result)
        {
            $result->status_id = $status;
            $result->save();
        }
        $result   = MailQuotation::with('user')->where('id', $id)->get();

        return view('portal.quotation.partial.render_data',  compact('result'))->render();
    }

    public function updateViews()
    {
        $record = $this->quotation;
        //$record->view_count = $record->view_count + 1;
        //$record->save();
        $record->increment('view_count');

        $exitCode = \Artisan::queue('notification:create', ['type'=> 'viewQuote', 'id' => $record->id]);

        return $record;

    }

    public function renderRow($id)
    {
        $result   = MailQuotation::where('id', $id)->get();
        $render   = view('portal.quotation.partial.render_data',  compact('result'))->render();
        return $render;
    }

    public function deleteRecord($id)
    {
        MailQuotation::destroy($id);
    }

}
