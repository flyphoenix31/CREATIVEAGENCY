<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CountryRepository;

class CountryController extends Controller
{
    public function __construct(CountryRepository $service)
    {
        $this->service = $service;
    }

	public function list(Request $request)
    {
        $attri  = [
            'category_name'    => 'countryList',
            'page_name'        => 'countryList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page  =  'country.list';

        if ($request->ajax())
        {
            $result = $this->service->PaginateRecordsWithFilter($request);

            return view('portal.country.micro.ajaxlist',  compact('result'))->render();
        }

        $result = collect([]);


		return view('portal',compact('page', 'attri', 'result'));
    }


    public function activateCountry(Request $request)
    {
        $id       = decryptId($request->id);

        $result = $this->service->activateCountry($id)->renderRow();

        return response()->json(['success' => true, 'id' => $id, 'data'=>$result]);
    }

    public function disableCountry(Request $request)
    {
        $id       = decryptId($request->id);

        $result = $this->service->disableCountry($id)->renderRow();

        return response()->json(['success' => true, 'id' => $id, 'data'=>$result]);
    }


}
