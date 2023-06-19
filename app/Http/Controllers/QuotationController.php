<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Repositories\QuotationRepository;
use App\Repositories\InvoiceRepository;
use App\Http\Requests\Quotation\UpdateQuotationRequest;
use App\Http\Requests\Invoice\SendQuotationRequest;
use App\Traits\SendMailTrait;

class QuotationController extends Controller
{
    use SendMailTrait;

    public function __construct(QuotationRepository $quotationservice, InvoiceRepository $invoiceservice)
    {
        $this->quotationservice = $quotationservice;
        $this->invoiceservice   = $invoiceservice;
    }

    public function quotationList(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->quotationservice->quotationWithFilter($request);

            return view('portal.quotation.partial.ajaxlist',  compact('result'))->render();
        }

        $attri  = [
            'category_name'    => 'quotation',
            'page_name'        => 'quotationList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'quotation.list';

        return view('portal', compact('page', 'result', 'attri'));
    }

    public function store(UpdateQuotationRequest $request)
    {
        $id = $this->quotationservice->storeRecord($request);

        if ($id)
        {
            $email   = $request->to_email;
            $subject = $request->subject;
            $content = $request->mail_content;
            $name    = $request->client_name;
            $email_data = [];

            $email_data['to_email'] = $email;
            $email_data['to_name']  = $name;
            $email_data['subject']  = $subject;
            $email_data['content']  = $content;

            $this->sendMail('quotemail', $email_data, 'html', 'quote');

            $render = $this->quotationservice->renderRow($id);
            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false ]);
    }

    public function destroy(Request $request)
    {
        $id = decryptId($request->id);
        $record = $this->quotationservice->deleteRecord($id);
        return response()
            ->json(['success' => true, 'id' => $id]);
    }

    public function sendQuotation(SendQuotationRequest $request)
    {
        $id     = decryptId($request->invoice_id);

        $link = $this->quotationservice->saveQuotationMail($request, $id)->getSharableLink();

        $record = $this->invoiceservice->findRecord($id)->getRecord();

        $email   = $request->to_email;
        $subject = $request->subject;
        $content = $request->mail_content;
        $name    = $record->client_name;
        $email_data = [];

        $url = route('view_quotation', $link);

        $arr = ['{CLIENT_NAME}' => $record->client_name, '{QUOTE_LINK}' => "<a href=".$url." class='btn btn-primary'>Quote Link</a>"];

        foreach ($arr as $key=>$val)
        {
            $content = str_replace($key,$val,$content);
        }


        $email_data['to_email'] = $email;
        $email_data['to_name']  = $name;
        $email_data['subject']  = $subject;
        $email_data['content']  = $content;
        //$this->sendMail('quotemail', $email_data, 'text');
        $this->sendMail('quotemail', $email_data, 'html', 'quote');

        $record->status_id = 2;
        $record->save();

        $activitydata['emails']   = $request->email;

        addUserActivity('Quotation',  'User Shared a Quotation in Mail', $activitydata);

        return response()->json(['success'   => false],  200);
    }

    public function viewQuotation(Request $request, $code)
    {
        $record = $this->quotationservice->getQuotation($code)->updateViews();

        $record = $this->quotationservice->findRecord($record->invoice_id)->changeToViewed()->getInvoiceRecord();

        $page   = 'invoice.preview_quotation';
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'previewquotation',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        addUserActivity('Quotation',  'Customer Viewed a Shared Quotation');

        return view('portal', compact('page', 'record', 'attri'));
    }

    public function GetQuotationStatus(Request $request)
    {
        $render = $this->quotationservice->GetQuotationStatus($request->id);

        return response()->json(['success' => true,'record'=>$render]);
    }

    public function UpdateQuotationStatus(Request $request)
    {
        $render = $this->quotationservice->updateQuotationStatus($request->id, $request->status_id);

        return response()->json(['success' => true,'mode' => 'edit','record'=>$render,'id'=>$request->id]);
    }

    public function deleteQuotation(Request $request)
    {
        $id = decryptId($request->id);

        Quotation::destroy($id);


        return response()->json(['success' => true, 'id'=> $id ]);
    }

    public function renderRow($id)
    {
        $result   = Contact::where('id', $id)->get();
        $render   = view('portal.contact.partial.render_data',  compact('result'))->render();
        return $render;
    }

}
