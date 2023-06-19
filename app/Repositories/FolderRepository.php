<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Files\Share;
use App\Models\Files\FileManagerFile;
use App\Models\Files\FileManagerFolder;
use App\Traits\FileUploadTrait;

class FolderRepository
{
    use FileUploadTrait;

    protected $folder;

    public function findRecord($id = null)
    {
        $folder = FileManagerFolder::findorfail($id);

        if ($folder)
        {
            $this->folder = $folder;
            return $this;
        }
    }

    public function findRecordByUuid($id = null)
    {
        $userId = \Auth::id();

        $folder   = FileManagerFolder::where('unique_id',$id);

        //is non super admin
        $folder = $folder->where('user_id', $userId);

        $folder = $folder->first();

        if ($folder)
        {
            $this->folder = $folder;
            return $this;
        }
    }

    public function getRecordByUuid($id)
    {
        if ($id)
        {
            $data = FileManagerFolder::with('parent')->where('unique_id',$id)->first();
            if ($data)
            {
                return $data;
            }

            abort(404);
        }
        abort(404);
    }

    public function getParentByUuid($id)
    {
        if ($id)
        {
            $data = FileManagerFolder::where('unique_id',$id)->first();
            if ($data)
            {
                return $data;
            }

            //abort(404);
        }
       // abort(404);
    }

    public function getParent($id)
    {
        if ($id)
        {
            $data = FileManagerFolder::where('id',$id)->first();
            if ($data)
            {
                return $data;
            }

            //abort(404);
        }
       // abort(404);
    }

    public function getParentId($id)
    {
        if ($id)
        {
            $data = FileManagerFolder::where('unique_id',$id)->first();
            if ($data)
            {
                return $data->id;
            }

            abort(404);
        }
        return 0;
    }

    public function getParentFromUuid($uuid)
    {
        if ($uuid)
        {
            $record = FileManagerFolder::where('unique_id',$uuid)->first();
            if ($record)
            {
                return $record->id;
            }
        }

        return 0;
    }


    public function createFolder(Request $request)
    {
        // Get variables
        $name      = $request->filled('foldername') ? $request->input('foldername') : 'New Folder';
        $parent    = $request->filled('uuid') ? $request->input('uuid') : '0';
        $parent    = $this->getParentFromUuid($parent);


        $user_id   = \Auth::id();

        // Create folder
        $folder = FileManagerFolder::create([
            'parent_id'  => $parent,
            'unique_id'  => unique_numeric_random( app(FileManagerFolder::class)->getTable(), 'unique_id', 5 ),
            'user_id'    => $user_id,
            'type'       => 'folder',
            'name'       => $name,
        ]);

        // Return new folder

        $this->folder = $folder;

        addUserActivity('Folder Manager',  'Created a Folder');

        return $this;
    }

    public function renderFolder($id = NULL)
    {
        $folder = $this->folder;

        if ($id)
        {
            $folder = FileManagerFolder::find($id);
        }

        return view('portal.files.micro.render_folder',  compact('folder'))->render();
    }

    public function getParentFolders($parentId , $type = 'default')
    {
        //\DB::enableQueryLog();
        $records = FileManagerFolder::with('shared')->IsParent($parentId);

        //dd(\DB::getQueryLog());

        switch($type)
        {
            case 'default':
            break;
            case 'starred':
                $records = $records->IsStarred();
            break;
            case 'shared':
                $records = $records->whereHas('shared', function($q) {
                    $q->havingRaw('COUNT(*) > 0');
                });
            break;
            case 'trash':
                $records = $records->onlyTrashed();
            break;
        }

        $records = $records->latest()->owned()->get();

        return $records;

    }





    public function addFiles(Request $request)
    {
        /* if (config('vuefilemanager.limit_storage_by_capacity') && user_storage_percentage() >= 100) {
            abort(423, 'You exceed your storage limit!');
        } */
    }


    public function destroy($id)
    {
        FileManagerFolder::destroy($id);

        return true;
    }


    public function rename($name)
    {
        $folder = $this->folder;

        if ($name)
        {
            $folder->name = $name;
            $folder->save();
            return $folder;
        }

        return false;
    }








}
