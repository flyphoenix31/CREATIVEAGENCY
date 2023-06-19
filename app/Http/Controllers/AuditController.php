<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AuditRepository;

class AuditController extends Controller
{
    public function __construct(AuditRepository $auditservice)
    {
        $this->auditservice = $auditservice;
    }

	public function list(Request $request)
    {

//        addUserActivity('View Report',  'User view Activity');


        $result = $this->auditservice->getRecords($request);

        foreach($result as $row)
        {
           // dd($row->causer->name);
        }

        //dd($result);
        $attri  = [
            'category_name'    => 'auditList',
            'page_name'        => 'auditList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'audit.list';

        if ($request->ajax())
        {
            $result = $this->auditservice->getRecords($request);

            return view('portal.audit.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }

    public function show(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->auditservice->getRecord($id);
		$render   = view('portal.audit.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }


}
