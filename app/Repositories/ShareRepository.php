<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Files\FileManagerFile;
use App\Models\Files\FileManagerFolder;
use App\Models\Files\Share;
use App\Traits\SendMailTrait;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use App\Models\Comment\Comment;

class ShareRepository
{
    use SendMailTrait;

    protected $share;
    protected $file;
    protected $folder;
    protected $record;

    public function findFileByUuid($id = null)
    {
        $userId = \Auth::id();

        $file   = FileManagerFile::where('unique_id',$id);

        //is non super admin
        $file = $file->where('user_id', $userId);

        $file = $file->first();

        if ($file)
        {
            $this->record = $file;
            return $this;
        }
    }

    public function findFolderByUuid($id = null)
    {
        $userId = \Auth::id();

        $folder   = FileManagerFolder::where('unique_id',$id);

        //is non super admin
        $folder = $folder->where('user_id', $userId);

        $folder = $folder->first();

        if ($folder)
        {
            $this->record = $folder;
            return $this;
        }
    }

    public function createLink($request, $type = 'file')
    {
        $expire = null;

        if ( $request->link_exp)
        {
            $expire = Carbon::now()->addHours($request->link_exp);
        }

        $file = $this->record;

        $options = [
            'password'    => $request->filled('password') ? \Hash::make($request->password) : null,
            'type'        => $type,
            'protected'   => $request->filled('password') ? 1 : null,
            'permission'  => 1, //view & Download
            'item_id'     => $file->unique_id,
            'user_id'     => \Auth::id(),
            'token'       => unique_random( app(Share::class)->getTable(), 'token', 4 ),
            'expire_at'   => $expire,
            'link_expire' => $request->link_exp,

        ];

        $record = Share::create($options);

        $this->share = $record;

        $extra['link'] = $record->link;

        addUserActivity('File Sharing',  'Created a Sharing link', $extra);

        return $this;
    }

    public function getShareRecord()
    {
        return $this->share;
    }

    public function removeSharing($request)
    {
        $file = $this->record;
        addUserActivity('File Sharing',  'Removed the Sharing Link');
        Share::where('item_id', $file->unique_id)->delete();
        return $this;
    }

    public function renderFile($id = NULL)
    {
        $list = $this->record;

        if ($id)
        {
            $list = FileManagerFile::find($id);
        }

        return view('portal.files.micro.viewfile',  compact('list'))->render();
    }

    public function renderFolder($id = NULL)
    {
        $folder = $this->record;

        if ($id)
        {
            $folder = FileManagerFolder::find($id);
        }

        return view('portal.files.micro.render_folder',  compact('folder'))->render();
    }

    public function updateRecord($request)
    {
        $data = $this->record;

        $record = Share::where('item_id', $data->unique_id)->first();

        $expire = null;
        if ( $request->link_exp)
        {
            $expire = Carbon::now()->addHours($request->link_exp);
        }


        if (\Hash::check($request->password, $record->password)) {
            // here you know data is valid
        }
        else
        {
            $password = $request->filled('password') ? \Hash::make($request->password) : null;
            $record->password = $password;
            $record->save();
        }

        //dd('f');

        $password = $request->filled('password') ? \Hash::make($request->password) : null;

        if ($password != $request->password)
        {
            $record->password = $password;
            $record->save();
        }

        if ($record->password)
        {
            $record->protected = 1;
        }
        else
        {
            $record->protected = null;
        }

        $record->expire_at   =  $expire;
        $record->link_expire = $request->link_exp;

        $record->save();

        addUserActivity('File Sharing',  'updated the File/Folder Sharing Data');

        return $this;
    }


    public function checkPassword($token, $password)
    {
        $share = Share::where('token', $token)
                        ->where('protected', 1)
                        ->first();

        if (\Hash::check($password, $share->password))
        {
            //Set Session
            session([$share->token.'_protected' => $share->token]);

            return TRUE;
        }


        return FALSE;
    }

    public function isShareData($token)
    {
        $share = Share::where('token', $token)->firstorfail();

        if ($share->expire_at)
        {
            if (Carbon::parse(now())->greaterThan($share->expire_at) == TRUE)
            {
                abort(404);
            }
        }

        return TRUE;
    }

    public function renderComment($id)
    {
        $comment = Comment::with('user','replies')->where('id', $id)->first();

        return view('portal.share.singlecomment',  compact('comment'))->render();
    }

    public function getComments($id)
    {
        return Comment::where('commentable_id', $id)->latest()->IsParent()->get();
    }

    public function getShareData($token)
    {
        $share = Share::where('token', $token)->firstorfail();

        if ($share->expire_at)
        {
            if (Carbon::parse(now())->greaterThan($share->expire_at) == TRUE)
            {
                abort(404);
            }
        }
        if ($share->protected)
        {
            return ['record' => $share, 'getpass' => TRUE];
        }

        return ['record' => $share, 'getpass' => false];
    }


    public function show($request,$share, $token, $folderId = 0)
    {
        $data  = '';

        $data   = FileManagerFile::where('unique_id',$share->item_id)->first();

        if ($share->type == 'file')
        {
            $data   = FileManagerFile::where('unique_id',$share->item_id)->first();
        }
        else if ($share->type == 'folder')
        {
            $record = FileManagerFolder::where('unique_id', $share->item_id)->first();

            if ($folderId)
            {
                $record = FileManagerFolder::where('unique_id', $folderId)->where('parent_id', $record->id)->firstorfail();
            }

            $data['folders']  = FileManagerFolder::where('parent_id',$record->id)->get();
            $data['files']    = FileManagerFile::IsParent($record->id)->get();
        }

        return $data;
    }


    public function shareLinkInMail($request)
    {
        $maillist = explode(',' , trim($request->new_share_emails, ','));

        $uuid   = $request->share_file_uuid;

        $record = Share::where('item_id', $uuid)->first();

        if (!$record) return false;

        $name    = '';

        $subject = 'Hello, '.\Auth::user()->name. ' Sharing a Portfolio link.';

        $content  = '';
        //$content .= "Hello, \r\n" . "I specially shared my work with you. please click the link and see my work. \r\n ";

        //$content .= "Link: ". route('shared_filesorfolder', $record->token) . "\r\n\r\n";

        $email_data = [];

        $email_data['to_name']  = $name;
        $email_data['subject']  = $subject;
        //$email_data['content']  = $content;
        $email_data['user']     = \Auth::user();
        $email_data['link']     = route('shared_filesorfolder', $record->token);


        foreach($maillist as $tomail)
        {
            $email_data['to_email'] = $tomail;
            $this->sendMail('fileshare', $email_data, 'html', 'sharelink');
        }

        $activitydata['emails']   = $request->new_share_emails;
        $activitydata['link']     = $record->link;

        addUserActivity('File Sharing',  'File Shared using a link with email', $activitydata);

    }



}
