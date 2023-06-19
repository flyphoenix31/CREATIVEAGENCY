<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Repositories\FolderRepository;
use App\Repositories\FileRepository;
use App\Repositories\ShareRepository;
use Zip;
use App\Http\Requests\ShareLink;
use Spatie\MediaLibrary\Support\MediaStream;

class ShareController extends Controller
{
    public function __construct(FolderRepository $folderservice, FileRepository $fileservice, ShareRepository $shareservice)
    {
        $this->folderservice = $folderservice;
        $this->fileservice   = $fileservice;
        $this->shareservice   = $shareservice;
    }

    public function show(Request $request, $token, $folderId = 0)
    {
        $parent  = null;

        $parentId = 0;
        $uuid = 0;
        $attri  = [
            'category_name'    => 'sharepage',
            'page_name'        => 'sharepage',
            'has_scrollspy'    => 0,
            'scrollspy_offset' => '',
            'alt_menu'         => 0,
        ];

        $page        = 'share.index';

        $sharedata    = $this->shareservice->getShareData($token);

        if ($sharedata['record']->type == 'folder')
        {

            $parent  = $this->folderservice->getParentByUuid($sharedata['record']->item_id);
        }

        //dd($parent);


        $result      = $this->shareservice->show($request, $sharedata['record'], $token, $folderId);

        //dd($result);

        $shared = $sharedata['record'];

        $tokenSession = session($token.'_protected');

        if ($sharedata['getpass'] == TRUE)
        {
            if ($tokenSession != $token)
            {
                $page        = 'portal.share.auth';
                return view('portal.share.auth', compact('page', 'result' ,'token'));
            }
        }

        $comments = $this->shareservice->getComments($shared->id);

        foreach($comments as $comment)
        {
            //print_r($comment->replies);echo '<br><br>';
        }

        //die();

        addUserActivity('File Sharing',  'Customer Visited the shared link');

        return view('share', compact('page', 'result' ,'token', 'shared', 'folderId', 'parent', 'comments'));
    }

    public function createFileShareLink(Request $request)
    {
        $uuid   = $request->create_file_uuid;
        if ($request->share_type == 'folder')
        {
            $link = $this->shareservice->findFolderByUuid($uuid)->createLink($request, 'folder');

            $record = $link->getShareRecord();
            $render = $link->renderFolder();
        }
        else
        {
            $link = $this->shareservice->findFileByUuid($uuid)->createLink($request, 'file');

            $record = $link->getShareRecord();
            $render = $link->renderFile();
        }

        return response()->json(['success' => true, 'id' => $uuid, 'render' => $render, 'type' => $request->share_type, 'record' => $record]);
    }

    public function mailFileLink(ShareLink $request)
    {
        $this->shareservice->shareLinkInMail($request);

        return response()->json(['success' => true]);
    }

    public function removeSharing(Request $request)
    {
        $uuid   = $request->id;

        if ($request->sharetype == 'folder')
        {
            $render = $this->shareservice->findFolderByUuid($uuid)->removeSharing($request)->renderFolder();
        }
        else
        {
            $render = $this->shareservice->findFileByUuid($uuid)->removeSharing($request)->renderFile();
        }

        return response()->json(['success' => true, 'id' => $uuid, 'render' => $render, 'type' => $request->sharetype ]);
    }


    public function EditShare(Request $request)
    {
        $uuid   = $request->edit_share_file_uuid;

        if ($request->edit_share_type == 'folder')
        {
            $render = $this->shareservice->findFolderByUuid($uuid)->updateRecord($request)->renderFolder();
        }
        else
        {
            $render = $this->shareservice->findFileByUuid($uuid)->updateRecord($request)->renderFile();
        }

        return response()->json(['success' => true, 'id' => $uuid, 'render' => $render, 'type' => $request->share_type]);
    }

    public function checkPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
        ]);

        $password  = $request->password;

        $sharedata = $this->shareservice->checkPassword($request->token, $password);

        if ($sharedata)
        {
            return response()->json([
                'success'     => true,
                'data'        => null,
            ]);
        }

        return response()->json(['success' => 'false', 'errors' => ['password' => [' Sorry, your password is incorrect.' ] ] ], 422);

    }

    public function download(Request $request, $token, $folderId = 0)
    {
        $directory = 'app/file-manager/';
        $sharedata     = $this->shareservice->getShareData($token);
        $share         = $sharedata['record'];
        $result        = $this->shareservice->show($request, $share, $token, $folderId);

        $tokenSession  = session($token.'_protected');

        if ($sharedata['getpass'] == TRUE)
        {
            if ($tokenSession != $token)
            {
                return response()->json(['success' => 'false', 'errors' => ['password' => [' Sorry, you cannot download.' ] ] ], 422);
            }
        }

        if ($share->type == 'file')
        {
            $fname = $result->basename;

            if (!empty($result->type == 'image'))
            {
                $fname =$result->name . '-wlarge.webp';


                $path = $result->publicimagepath;
            }
            else
            {
                $path = storage_path().'/'.$directory.$fname;
            }

            addUserActivity('File Sharing',  'Customer Downloaded a File');

            if (file_exists($path)) {
                return \Response::download($path, $result->name);
            }
        }
        else
        {
            //Check all or single file
            //zip and download

            addUserActivity('File Sharing',  'Customer Downloaded Folder or Multiple files.');

            $result      = $this->shareservice->show($request, $sharedata['record'], $token, $folderId);

            $dd = Zip::create(\Str::random(20).".zip");


            if (!$folderId)
            {
                foreach($result['folders'] as $folder)
                {

                    $folist  = $this->shareservice->show($request, $sharedata['record'], $token, $folder->unique_id);

                    foreach($folist['files'] as $file)
                    {
                        $path = storage_path().'/'.$directory.$file->basename;

                        $dd->add($path);

                    }

                }
            }

            foreach($result['files'] as $file)
            {
                $path = storage_path().'/'.$directory.$file->basename;

                $dd->add($path);
            }

            return $dd;
        }
    }


}
