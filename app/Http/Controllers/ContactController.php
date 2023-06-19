<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContactRepository;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;

class ContactController extends Controller
{
    public function __construct(ContactRepository $contactservice)
    {
        $this->contactservice = $contactservice;
    }

    public function list(Request $request)
    {
        if ($request->ajax())
        {
            $result = $this->contactservice->PaginateRecordsWithFilter($request);

            return view('portal.contact.partial.ajaxlist',  compact('result'))->render();
        }

        $attri  = [
            'category_name'    => 'contactList',
            'page_name'        => 'contactList',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'contact.list';
        return view('portal', compact('page', 'result', 'attri'));
    }

    public function showContact(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->contactservice->getRecord($id);
		$render   = view('portal.contact.partial.render_edit',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function viewContact(Request $request)
    {
    	$id       = decryptId($request->id);
		$result   = $this->contactservice->getRecord($id);
		$render   = view('portal.contact.partial.render_view',  compact('result'))->render();

		return response()->json(['success' => true,'record'=>$render]);
    }

    public function store(StoreContactRequest $request)
    {
        $id = $this->contactservice->storeRecord($request);

        if ($id)
        {
            $render = $this->contactservice->renderRow($id);
            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false ]);
    }

    public function update(UpdateContactRequest $request)
    {
        $result = $this->contactservice->updateRecord($request);

        if ($result)
        {
            $id = decryptId($request->id);
            $render = $this->contactservice->renderRow($id);
            return response()->json(['success' => true,'record'=>$render]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy(Request $request)
    {
        $id = decryptId($request->id);
        $record = $this->contactservice->deleteRecord($id);
        return response()
            ->json(['success' => true, 'id' => $id]);
    }

    public function sendQuotation(Request $request, $id)
    {
        return response()->json(['success'   => false],  200);
    }

}
