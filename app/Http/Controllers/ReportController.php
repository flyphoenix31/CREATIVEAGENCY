<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
    public function __construct(ReportRepository $reportservice)
    {
        $this->reportservice = $reportservice;
    }

	public function sharedLink(Request $request)
    {

        $attri  = [
            'category_name'    => 'sharedLink',
            'page_name'        => 'sharedLink',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'report.sharelink.list';

        if ($request->ajax())
        {
            $result = $this->reportservice->PaginateSharedlink($request);

            return view('portal.report.sharelink.partial.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }


}
