<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Repositories\FolderRepository;
use App\Repositories\FileRepository;
use App\Repositories\ShareRepository;
use App\Http\Requests\Quotation\UpdateQuotationRequest;
use App\Http\Requests\Invoice\SendQuotationRequest;
use Validator;

class FilesController extends Controller
{
    public function __construct(FolderRepository $folderservice, FileRepository $fileservice, ShareRepository $shareservice)
    {
        $this->folderservice = $folderservice;
        $this->fileservice   = $fileservice;
        $this->shareservice   = $shareservice;
    }

    public function FileList(Request $request, $type = 'default')
    {
        $parent = '';
        $parentId = 0;
        $uuid = 0;
        $attri  = [
            'category_name'    => 'files',
            'page_name'        => 'filelist',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $result      = collect([]);
        $page        = 'files.list';
        $page        = 'files.liss';

        $folderlist  = $this->folderservice->getParentFolders($parentId, $type);

        $filelist    = $this->fileservice->getFiles($parentId, $type);

        return view('file', compact('page', 'result', 'attri', 'folderlist', 'filelist', 'uuid', 'type', 'parent'));
    }



    public function addFiles(Request $request)
    {
        $validator = $this->validate($request,[
            'userfiles' => 'required|file|max:2000',
        ],
            [
                'userfiles.max' => 'Your file must lesser than 2MB',
            ]
        );

        $render = $this->fileservice->addFiles($request)->renderFile();

        return response()->json(['success' => true, 'render' => $render ]);


        return response()->json(['success' => true]);
    }

    public function rename(Request $request)
    {
        $id = $request->fileid;

        $result = $this->fileservice->findRecord($id)->rename($request->name);

        if ($result)
        {
            return response()->json(['success' => true, 'id' => $id, 'name' => $result->name ]);
        }

        return response()->json(['success' => false, 'error_message' => 'something problem']);
    }


    public function restoreFile(Request $request)
    {
        $id   = $request->id;
        $id   = $this->fileservice->restore($id);return response()->json(['success' => true, 'id' => $id ]);

        if ($id)
        {
            return response()->json(['success' => true, 'id' => $id ]);
        }

        return response()->json(['success' => false, 'message' => 'can not restore the file.Permission denied']);

    }


    public function deleteFile(Request $request)
    {
        $id   = $request->id;
        $id   = $this->fileservice->destroy($id);

        if ($id)
        {
            return response()->json(['success' => true, 'id' => $id ]);
        }

        return response()->json(['success' => false, 'message' => 'can not delete the file.Permission denied']);

    }

    public function deletePermanently(Request $request)
    {
        $id   = $request->id;
        $id   = $this->fileservice->deletePermanently($id);

        if ($id)
        {
            return response()->json(['success' => true, 'id' => $id ]);
        }

        return response()->json(['success' => false, 'message' => 'can not delete the file.Permission denied']);

    }












}
