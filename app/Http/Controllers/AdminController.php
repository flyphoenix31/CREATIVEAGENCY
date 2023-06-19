<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\Contact;
use App\Repositories\InvoiceRepository;
use App\Repositories\QuotationRepository;
use App\Repositories\ContactRepository;
use App\Repositories\SettingRepository;
use App\Http\Requests\EnquiryReplyRequest;

class AdminController extends Controller
{
    public function __construct(InvoiceRepository $invoiceservice, QuotationRepository $quotationservice, ContactRepository $contactservice, SettingRepository $settingservice)
    {
        $this->quotationservice = $quotationservice;
        $this->contactservice   = $contactservice;
        $this->settingservice   = $settingservice;
        $this->invoiceservice   = $invoiceservice;
    }

	public function dashboard()
    {
        $attri  = [
            'category_name'    => 'dashboard',
            'page_name'        => 'dashboard',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $new_request       =  Enquiry::whereDate('created_at', '>=' , \Carbon\Carbon::now()->subDays(5))->count();
        $new_contacts      = $this->contactservice->getLatestContactCount(5);
        $latest_invoices   = $this->invoiceservice->getLatestInvoices(5);
        $latest_quotations = $this->quotationservice->getLatestQuotations(5);
        $portfolio         = \App\Models\Portfolio::Active()->count();

        $page              =  'dashboard.admin';

		return view('portal',compact('page','new_request','new_contacts', 'attri', 'latest_invoices', 'latest_quotations','portfolio'));
    }


    public function enquiryList(Request $request)
    {
        $attri  = [
            'category_name'    => 'enquiryList',
            'page_name'        => 'enquiryList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,

        ];

        if ($request->ajax()) {
            $result = Enquiry::Filter((object)$request->all())->latest()->paginate(\config('pm.cmspagination'));

            return view('portal.enquiry.partial.ajaxlist',  compact('result'))->render();
        }
        $result      = collect([]);
        $page        = 'enquiry.list';
        return view('portal', compact('page', 'result','attri'));
    }

    public function viewEnquiry(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = Enquiry::find($id);
		$render   = view('portal.enquiry.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function convertEnquiry(Request $request)
    {
        $id = \Crypt::decryptString($request->id);
        $enquiry = Enquiry::find($id);
        $ins = [
            'name' => $enquiry->name,
            'email' => $enquiry->email,
            'status_id' => 1
        ];


        $user = Contact::updateOrCreate(
            ['email' => $enquiry->email],
            ['name' => $enquiry->name, 'email' => $enquiry->email, 'status_id' => 1 ]
        );

        $enquiry->is_converted = 1;
        $enquiry->save();

        $render = self::render_enquiry($id);

        return response()->json(['success' => true, 'id' => $id, 'render' => $render]);
    }

    private function render_enquiry($id)
    {
        $result   = Enquiry::where('id', $id)->get();
        $record   =  view('portal.enquiry.partial.render_data', compact( 'result' ) )->render();
        return $record;
    }


    public function destroyEnquiry(Request $request)
    {
        $id = \Crypt::decryptString($request->id);

        Enquiry::destroy($id);


        return response()->json(['success' => true, 'id'=> $id ]);
    }


    public function setting(Request $request)
    {
    	$record  = $this->settingservice->getSettings();
		$page    = 'setting.index';

        $attri  = [
            'category_name'    => 'settings',
            'page_name'        => 'setting',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        return view('portal', compact('page','record','attri'));
    }

	public function update_setting (Request $request)
	{
		$data['page']    = 'setting.index';

		$validator = $this->validate(
            $request,
            [
                'account_number' => 'required',
      			'bank_name'      => 'required',
				'bank_code'      => 'required',
                'bank_country'   => 'required',
            ]
        );

        $record  = $this->settingservice->updateSettings($request);

		/* $record = new Setting();
		$record->exists = true;
		$record->id = 1;
		$record->fill($request->all());
		$record->save(); */

		return redirect()->back()->with('message', trans('lang.setting_success_save_message') );
		return view('main', $data);
	}

    public function replyEnquiry(EnquiryReplyRequest $request)
    {
        $id      = decryptId($request->enquiry_id);

        $record  = Enquiry::where('id', $id)->first();

        $email   = $request->email;
        $subject = $request->subject;
        $content = $request->mail_content;
        $name    = $record->name;

         \Mail::send([], $email_data, function ($message) use ($email , $subject, $content, $name)
        {
            $message->from('test@gmail.com');
            $message->to($email, $name);
            $message->subject($subject);
            $message->setBody($content,'text/html');
        });

        $record->is_replied = 1;
        $record->save();

        $render = self::render_enquiry($id);

        return response()->json(['success' => true, 'id' => $id, 'render' => $render]);
    }



}
