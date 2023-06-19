<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Portfolio\StorePortfolioRequest;
use App\Http\Requests\Portfolio\UpdatePortfolioRequest;
use App\Repositories\PortfolioRepository;

class PortfolioController extends Controller
{
    public function __construct(PortfolioRepository $portfolioservice)
    {
        $this->portfolioservice = $portfolioservice;
    }

    public function list(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->portfolioservice->PaginateRecordsWithFilter($request);

            return view('portal.portfolio.partial.ajaxlist',  compact('result'))->render();
        }

        $attri  = [
            'category_name'    => 'portfolio',
            'page_name'        => 'portfolio_list',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'portfolio.list';

        return view('portal', compact('page', 'result', 'attri'));
    }

    public function show(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->portfolioservice->getRecord($id);
		$render   = view('portal.portfolio.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function create(Request $request)
    {
        $attri  = [
            'category_name'    => 'portfolio',
            'page_name'        => 'add_portfolio',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page    = 'portfolio.page.create';

        return view('portal', compact('page', 'attri'));
    }

    public function edit($id)
    {
        $page   = 'portfolio.page.edit';
        $record = $this->portfolioservice->getRecord(decryptId($id));

        $attri  = [
            'category_name'    => 'portfolio',
            'page_name'        => 'edit_portfolio',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        return view('portal', compact('page', 'record', 'attri'));
    }

    public function store(StorePortfolioRequest $request)
    {
        $id = $this->portfolioservice->storeRecord($request);

        if ($id)
        {
            return response()->json(['success' => true, 'url' => route('portfoliolist')]);
        }

        return response()->json(['success' => false ]);
    }

    public function update(UpdatePortfolioRequest $request)
    {
        $result = $this->portfolioservice->updateRecord($request);

        if ($result)
        {
            return response()->json(['success' => true, 'url' => route('portfoliolist')]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy(Request $request)
    {
        $id = decryptId($request->id);
        $record = $this->portfolioservice->deleteRecord($id);
        return response()
            ->json(['success' => true, 'id' => $id]);
    }

}
