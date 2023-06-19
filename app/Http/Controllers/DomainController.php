<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DomainRepository;
use App\Http\Requests\Domain\StoreRequest;
use App\Http\Requests\Domain\UpdateRequest;

class DomainController extends Controller
{
    public function __construct(DomainRepository $domainService)
    {
        $this->domainService = $domainService;
    }

    public function list(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->domainService->PaginateRecordsWithFilter($request);

            return view('portal.domain.partial.ajaxlist',  compact('result'))->render();
        }

        $attri  = [
            'category_name'    => 'domainList',
            'page_name'        => 'domainList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'domain.list';
        return view('portal', compact('page', 'result', 'attri'));
    }

    public function showContact(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->domainService->getRecord($id);
		$render   = view('portal.domain.partial.render_edit',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function viewContact(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->domainService->getRecord($id);
		$render   = view('portal.domain.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function store(StoreRequest $request)
    {
        $id = $this->domainService->storeRecord($request);

        if ($id)
        {
            $render = $this->domainService->renderRow($id);
            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false ]);
    }

    public function update(UpdateContactRequest $request)
    {
        $result = $this->domainService->updateRecord($request);

        if ($result)
        {
            $id = decryptId($request->id);
            $render = $this->domainService->renderRow($id);
            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy(Request $request)
    {
        $id = decryptId($request->id);
        $record = $this->domainService->deleteRecord($id);
        return response()
            ->json(['success' => true, 'id' => $id]);
    }

    public function sendQuotation(Request $request, $id)
    {
        return response()->json(['success'   => false],  200);
    }

}
