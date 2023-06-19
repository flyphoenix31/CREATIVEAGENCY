<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Repositories\FolderRepository;
use App\Repositories\FileRepository;

class FolderController extends Controller
{
    public function __construct(FolderRepository $folderservice, FileRepository $fileservice)
    {
        $this->folderservice = $folderservice;
        $this->fileservice   = $fileservice;
    }

    public function FolderList(Request $request, $uuid = 0)
    {
        $record  = $this->folderservice->getRecordByUuid($uuid);

        $parent  = $this->folderservice->getParent($record->parent_id);

        //dd($record);

        if ($request->ajax())
        {

        }

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

        $folderlist  = $this->folderservice->getParentFolders($record->id);

        $filelist    = $this->fileservice->getFiles($record->id);

        $type = 'default';

        return view('file', compact('page', 'result', 'attri', 'folderlist', 'filelist', 'uuid', 'type', 'parent', 'record'));
    }

    public function createFolder(Request $request)
    {
        $result = $this->folderservice->createFolder($request)->renderFolder();

        return response()->json(['success' => true, 'render' => $result]);
    }

    public function destroy(Request $request)
    {
        $result = $this->folderservice->destroy($request->id);

        return response()->json(['success' => true]);
    }

    public function rename(Request $request)
    {
        $id = $request->folerid;
        $result = $this->folderservice->findRecord($id)->rename($request->folder_new_name);

        if ($result)
        {
            return response()->json(['success' => true, 'id' => $id, 'name' => $result->name ]);
        }

        return response()->json(['success' => false, 'error_message' => 'something problem']);
    }





}
