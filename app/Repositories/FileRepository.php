<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Files\FileManagerFile;
use App\Models\Files\FileManagerFolder;
use App\Models\Files\Share;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class FileRepository
{
    use FileUploadTrait;

    protected $file;

    public function findRecord($id = null)
    {
        //$file = FileManagerFile::findorfail($id);

        $userId = \Auth::id();
        $file   = FileManagerFile::where('id',$id);

        //is non super admin
        $file = $file->where('user_id', $userId);

        $file = $file->first();


        if ($file)
        {
            $this->file = $file;
            return $this;
        }
        else
        {
            abort(404);
        }
    }

    public function findRecordByUuid($id = null)
    {
        $userId = \Auth::id();

        $file   = FileManagerFile::where('unique_id',$id);

        //is non super admin
        $file = $file->where('user_id', $userId);

        $file = $file->first();

        if ($file)
        {
            $this->file = $file;
            return $this;
        }
    }

    public function renderFile($id = NULL)
    {
        $list = $this->file;

        if ($id)
        {
            $list = FileManagerFile::find($id);
        }

        return view('portal.files.micro.viewfile',  compact('list'))->render();
    }

    public function destroy($id)
    {
        $userId = \Auth::id();

        $file   = FileManagerFile::where('id',$id);

        $file = $file->where('user_id', $userId)->first();

        if ($file)
        {
            $file->delete();

            addUserActivity('File Manager',  'Destroyed File');

            return TRUE;
        }
        return FALSE;
    }

    public function deletePermanently($id)
    {
        $userId = \Auth::id();

        $file   = FileManagerFile::where('id',$id);

        $file = $file->onlyTrashed()->where('user_id', $userId)->first();

        if ($file)
        {
            $file->forceDelete();

            addUserActivity('File Manager',  'Forcefully Destroyed the File');

            return TRUE;
        }
        return FALSE;
    }

    public function restore($id)
    {
        $userId = \Auth::id();

        $file   = FileManagerFile::where('id',$id);

        $file = $file->onlyTrashed()->where('user_id', $userId)->first();

        if ($file)
        {
            $file->restore();

            addUserActivity('File Manager',  'Restored a File');

            return TRUE;
        }
        return FALSE;
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



    public function addFiles($request)
    {
        $user_id      = \Auth::id();

        $folder_id    = $request->filled('uuid') ? $request->input('uuid') : '0';
        $folder_id    = $this->getParentFromUuid($folder_id);

        $file = $request->file('userfiles');

        // File
        $filename = Str::random() . '-' . str_replace(' ', '', $file->getClientOriginalName());
        $filetype = get_file_type($file);
        $filesize = $file->getSize();
        $directory = 'file-manager';
        $thumbnail = null;

        // create directory if not exist
        if (!\Storage::exists($directory)) {
            \Storage::makeDirectory($directory);
        }

        $addimage = null;

        // Create image thumbnail
        if (in_array($file->getMimeType(), ['image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/webp'])) {

            $addimage = 'yes';

            /* // Get thumbnail name
            $thumbnail = 'thumbnail-' . $filename;

            // Create intervention image
            $image = Image::make($file->getRealPath())->orientate();

            // Resize image
            $image->resize(564, null, function ($constraint) {
                $constraint->aspectRatio();
            })->stream();

            // Store thumbnail to disk
            \Storage::put($directory . '/' . $thumbnail, $image); */

        } elseif ($file->getMimeType() == 'image/svg+xml') {
            // Store to disk
            \Storage::putFileAs($directory, $file, $filename, 'private');

            $thumbnail = $filename;
        }



        // Store file
        $options = [
            'name'       => pathinfo($file->getClientOriginalName())['filename'],
            'mimetype'   =>  $request->file('userfiles')->getClientOriginalExtension(),
            'unique_id'  => unique_numeric_random( app(FileManagerFile::class)->getTable(), 'unique_id', 5 ),
            'user_scope' => 'master',
            'folder_id'  => $folder_id,
            'thumbnail'  => $thumbnail,
            'basename'   => $filename,
            'filesize'   => $filesize,
            'type'       => $filetype,
            'user_id'    => $user_id,
        ];

        $this->file = $record = FileManagerFile::create($options);

        if($addimage )
        {
            $this->saveFile($record, 'userfiles', 'userfiles');
        }
        addUserActivity('File Manager',  'Added a File');

        return $this;

        // Return new file
        return true;
    }

    public function getFiles($parentId = 0, $type = 0)
    {

        $records = FileManagerFile::with('shared')->withCount('shared')->IsParent($parentId);

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

        return $records->latest()->owned()->paginate(15);
    }


    public function privilegedDestroy($id)
    {
        FileManagerFile::destroy($id);

        return true;
    }


    public function rename($name)
    {
        $file = $this->file;

        if ($name)
        {
            $file->name = $name;
            $file->save();

            addUserActivity('File Manager',  'Renamed a File');

            return $file;
        }

        return false;
    }






}
