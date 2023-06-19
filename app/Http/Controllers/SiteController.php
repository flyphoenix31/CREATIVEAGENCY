<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserEnquiryRequest;
use App\Models\Portfolio;
use App\Models\Enquiry;

class SiteController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::Active()->latest()->get();

        return view('site.index', compact('portfolio'));
    }

    public function services()
    {
        return view('site.services');
    }

    public function about()
    {
        return view('site.about');
    }

    public function contactus()
    {
        return view('site.contact_us');
    }

    public function portfolio()
    {
        $records = Portfolio::Active()->latest()->get();

        return view('site.portfolio', compact('records'));

        return view('site.portfolio');
    }

    public function service_more($type)
    {
        switch($type)
        {
            case('webdev'):
                return view('site.services_detail');
            break;
        }

        return view('site.404');

    }

    public function portfolio_detail($slug)
    {
        $record = Portfolio::Active()->where('slug_url', $slug)->first();

        if ($record)
        {
            return view('site.portfolio_detail', compact('record'));
        }

        return view('site.404');
    }




    public function createRequest(UserEnquiryRequest $request)
    {
        $record = Enquiry::create($request->validated());

        return response()->json(['success' => true, 'message' => 'Thank You! Your message has been sent.']);

        //return view('site.service_detail');
    }



}
