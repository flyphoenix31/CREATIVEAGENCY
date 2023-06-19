<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MailRepository;
use App\Http\Requests\Mail\StoreMailRequest;
use App\Http\Requests\Mail\UpdateMailRequest;

class MailController extends Controller
{
    public function __construct(MailRepository $mailservice)
    {
        $this->mailservice = $mailservice;
    }

	public function list(Request $request)
    {
        $attri  = [
            'category_name'    => 'mailList',
            'page_name'        => 'mailList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'mail.list';

        if ($request->ajax())
        {
            $result = $this->mailservice->getRecords($request);

            return view('portal.mail.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }


    public function ChangeMailAccount(Request $request)
    {
        $result = $this->mailservice->ChangeMailAccount($request);

        return response()->json(['success' => TRUE ]);
    }

    public function store(StoreMailRequest $request)
    {
        $id = $this->mailservice->storeRecord($request);

        if ($id)
        {
            $render = $this->mailservice->renderRow($id);

            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false ]);
    }

    public function show(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->mailservice->getRecord($id);
		$render   = view('portal.mail.partial.render_edit',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function update(UpdateMailRequest $request)
    {
        $result = $this->mailservice->updateRecord($request);

        if ($result)
        {
            $id = decryptId($request->id);
            $render = $this->mailservice->renderRow($id);
            return response()->json(['success' => true, 'id'=> $id, 'record'=>$render]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy(Request $request)
    {
        $id = decryptId($request->id);
        $record   = $this->mailservice->getRecord($id);
        if ($record->is_default ==1 )
        {
            return response()
            ->json(['success' => false, 'error' => 'Sorry, You cannot delete active mail account.']);
        }
        //$record = $this->mailservice->deleteRecord($id);
        return response()
            ->json(['success' => true, 'id' => $id]);
    }

    public function DailyLimit(Request $request)
    {
        $attri  = [
            'category_name'    => 'mailList',
            'page_name'        => 'mailList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'report.dailylimit.list';

        if ($request->ajax())
        {
            $result = $this->mailservice->DailyLimit($request);

            return view('portal.report.dailylimit.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }

    public function MailErrorList(Request $request)
    {
        $attri  = [
            'category_name'    => 'report',
            'page_name'        => 'mailErrorList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'report.mailerrorlist.list';

        if ($request->ajax())
        {
            $result = $this->mailservice->MailErrorList($request);

            return view('portal.report.mailerrorlist.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }



}
