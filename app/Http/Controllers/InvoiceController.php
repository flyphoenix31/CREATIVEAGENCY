<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\InvoiceRepository;
use PDF;
use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Requests\Invoice\SendQuotationRequest;
use App\Repositories\SettingRepository;
use Spatie\Browsershot\Browsershot;
use SnappyPdf;

class InvoiceController extends Controller
{
    public function __construct(InvoiceRepository $invoiceservice, SettingRepository $settingservice)
    {
        $this->invoiceservice = $invoiceservice;
        $this->settingservice = $settingservice;
    }

    public function list(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->invoiceservice->PaginateRecordsWithFilter($request);

            return view('portal.invoice.partial.ajaxlist',  compact('result'))->render();
        }

        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'InvoiceList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'invoice.list';

        return view('portal', compact('page', 'result', 'attri'));
    }

    public function create(Request $request)
    {
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'create_invoice',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $setting     = $this->settingservice->getSettings();
        $countries   = \App\Models\Currency::active()->get();
        $page        = 'invoice.create';
        return view('portal', compact('page', 'result', 'attri', 'setting', 'countries'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $id = $this->invoiceservice->storeRecord($request);

        if ($id)
        {
            $id = encryptId($id);
            return response()->json(['success' => true, 'url' => route('preview_invoice',$id)]);
        }

        return response()->json(['success' => false]);
    }

    public function edit($id)
    {
        $page   = 'invoice.edit';
        $record = $this->invoiceservice->findRecord(decryptId($id))->getRecord();
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'edit_invoice',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $countries = \App\Models\Currency::active()->get();

        //dd($record->currency, decryptId($id));

        $setting     = $this->settingservice->getSettings();


        return view('portal', compact('page', 'record', 'attri', 'setting', 'countries'));
    }

    public function update(UpdateInvoiceRequest $request)
    {
        $result = $this->invoiceservice->updateRecord($request);

        if ($result)
        {
            return response()->json(['success' => true, 'url' => route('preview_invoice',$request->id)]);
        }

        return response()->json(['success' => false]);
    }

    public function preview(Request $request, $id)
    {
        $record = $this->invoiceservice->findRecord(decryptId($id))->getRecord();

        $page   = 'invoice.preview';
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'preview_invoice',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        return view('portal', compact('page', 'record', 'attri'));
    }


    public function intdownload(Request $request, $id)
    {
        $record = $this->invoiceservice->findRecord($id)->getRecord();

        $page   = 'invoice.download_quotation';
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'downloadinvoice',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        return view('portal', compact('page', 'record', 'attri'));
    }


    public function download(Request $request, $id)
    {
        $record = $this->invoiceservice->findRecord($id)->getRecord();

        //$page   = 'invoice.download_quotation';
        $attri  = [
            'category_name'    => 'invoice',
            'page_name'        => 'previewquotation',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $view = 'portal.invoice.pdf';
        $page   = 'invoice.download_invoice';

        //return view('pdf', compact('page', 'record', 'attri'));

        $pdf = PDF::loadView('pdf', ['record' => $record, 'page' => $page, 'attri' => $attri ]);



        $pdf = PDF::loadview('pdf', compact('record', 'page', 'attri'));


        //$content = $pdf->setOption('temp_dir', '/var/www/creative/storage/app/public/');
        return $pdf->download($record->invoice_number.'.pdf');
        //\Storage::put('public/adad.pdf',$content);

        dd('--Done');


        $pdf->save(public_path("/pdf/" . $record->invoice_number.'.pdf'));

        $path = public_path("/pdf/" . $record->invoice_number.'.pdf');

        $pdf = PDF::loadView('pdf', ['record' => $record, 'page' => $page, 'attri' => $attri ])->save($path);


        //return $pdf->stream();

        return $pdf->download($record->invoice_number.'.pdf');
        dd('done');

        //dd($pdf);

        //return view('pdf', compact('record', 'page', 'attri'));

        //return $pdf->stream();


        return $pdf->download($record->invoice_number.'.pdf');


    }

    public function olddownload($id=135)
    {

        $record = $this->invoiceservice->findRecord($id)->getRecord();

        $view = 'portal.invoice.pdf';
        //$view = 'portal.invoice.partial.invoicepreview';
        //return view($view , compact('record'));


        $pdf = PDF::loadView($view , ['record' => $record]);

        return view($view, compact( 'record'));


        return $pdf->download('invoice.pdf');

        //$pdf = PDF::loadView('portal.invoice.partial.invoicepreview', ['record' => $record]);
        return $pdf->stream();

        //->setPaper('a4')

        dd('d');




        view()->share('record',$record);



        $pdf = PDF::loadView('portal.invoice.partial.invoicepreview', $record);

        return $pdf->download('pdf_file.pdf');
    }





}
