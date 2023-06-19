<?php

namespace App\Models\Files;

use ByteUnits\Metric;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use \Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;

class FileManagerFile extends Model implements HasMedia
{
    use Searchable, SoftDeletes, InteractsWithMedia;

    public $public_access = null;

    protected $guarded = [
        'id'
    ];

    protected $appends = [
        'file_url', 'thumbnail', 'publicimage', 'thumb'
    ];

    /**
     * Set routes with public access
     *
     * @param $token
     */
    public function setPublicUrl($token)
    {
        $this->public_access = $token;
    }

    /**
     * Format fileSize
     *
     * @return string
     */
    public function getFilesizeAttribute()
    {
        return Metric::bytes($this->attributes['filesize'])->format();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $sizes = [
                    'medium'  => ['name'=> 'large', 'width' => 600 ],
                    'small'   => ['name'=> 'small', 'width' => 200 ],
                    'thumb'   => ['name'=> 'thumb', 'width' => 60 ]
                ];

        foreach($sizes as $size)
        {
            $this->addMediaConversion($size['name'])
            ->width($size['width'])
            ->optimize();
        }


        $sizes = [
            'medium'  => ['name'=> 'wlarge', 'width' => 1200 ],
            'small'   => ['name'=> 'wsmall', 'width' => 400 ],
            'thumb'   => ['name'=> 'wthumb', 'width' => 100 ]
        ];


        foreach($sizes as $size)
        {
        $this->addMediaConversion($size['name'])
                ->width($size['width'])
                ->watermark(public_path('images/logo.png'))
                ->watermarkOpacity(65)
                ->watermarkPosition(Manipulations::POSITION_CENTER)      // Watermark at the top
                ->watermarkHeight(15, Manipulations::UNIT_PERCENT)    // 50 percent height
                ->watermarkWidth(21, Manipulations::UNIT_PERCENT)
                ->watermarkPadding(30)
                ->sharpen(10)
                //->format('webp')
                ;
        }
    }

    public function getPublicImageAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl('wlarge');
        }
    }

    public function getPublicImagePathAttribute()
    {
        return $this->media->first()->getPath('wlarge');
    }

    public function getThumbAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl('thumb');
        }
    }


    /**
     * Format thumbnail url
     *
     * @return string
     */
    public function getThumbnailAttribute()
    {
        // Get thumbnail from s3
        if ($this->attributes['thumbnail'] && is_storage_driver(['s3', 'spaces'])) {

            return Storage::temporaryUrl('file-manager/' . $this->attributes['thumbnail'], now()->addDay());
        }

        // Get thumbnail from local storage
        if ($this->attributes['thumbnail'] && is_storage_driver('local')) {

            // Thumbnail route
            $route = route('thumbnail', ['name' => $this->attributes['thumbnail']]);

            if ($this->public_access) {
                return $route . '/public/' . $this->public_access;
            }

            return $route;
        }

        return null;
    }



    public function getShareFileUrlAttribute()
    {
         // Get file from s3
        if (is_storage_driver(['s3', 'spaces'])) {

            $header = [
                "ResponseAcceptRanges"       => "bytes",
                "ResponseContentType"        => $this->attributes['mimetype'],
                "ResponseContentLength"      => $this->attributes['filesize'],
                "ResponseContentRange"       => "bytes 0-600/" . $this->attributes['filesize'],
                'ResponseContentDisposition' => 'attachment; filename=' . $this->attributes['name'] . '.' . $this->attributes['mimetype'],
            ];

            return Storage::temporaryUrl('file-manager/' . $this->attributes['basename'], now()->addDay(), $header);
        }

        // Get thumbnail from local storage
        if (is_storage_driver('local')) {

            //$route = route('file', ['name' => $this->attributes['basename']]);
            $route = route('get_shared_file', ['name' => $this->attributes['unique_id']]);

            if ($this->public_access) {
                return $route . '/public/' . $this->public_access;
            }

            return $route;
        }
    }


    public function getFileUrlAttribute()
    {
         // Get file from s3
        if (is_storage_driver(['s3', 'spaces'])) {

            $header = [
                "ResponseAcceptRanges"       => "bytes",
                "ResponseContentType"        => $this->attributes['mimetype'],
                "ResponseContentLength"      => $this->attributes['filesize'],
                "ResponseContentRange"       => "bytes 0-600/" . $this->attributes['filesize'],
                'ResponseContentDisposition' => 'attachment; filename=' . $this->attributes['name'] . '.' . $this->attributes['mimetype'],
            ];

            return Storage::temporaryUrl('file-manager/' . $this->attributes['basename'], now()->addDay(), $header);
        }

        // Get thumbnail from local storage
        if (is_storage_driver('local')) {

            //$route = route('file', ['name' => $this->attributes['basename']]);
            $route = route('file', ['name' => $this->attributes['unique_id']]);

            if ($this->public_access) {
                return $route . '/public/' . $this->public_access;
            }

            return $route;
        }
    }

    /**
     * Index file
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
        $name = Str::slug($array['name'], ' ');

        return [
            'id'         => $this->id,
            'name'       => $name,
            'nameNgrams' => utf8_encode((new TNTIndexer)->buildTrigrams(implode(', ', [$name]))),
        ];
    }



    //Scopes
    public function ScopeIsParent($query, $parentId)
    {
        //if ($parentId)
        //{
            return $query->where('folder_id',  $parentId);
        //}
    }

    public function ScopeIsStarred($query)
    {
        return $query->where('is_starred',  1);
    }

    public function ScopeOwned($query)
    {
        return $query->where('user_id',  \Auth::id());
    }






    /**
     * Get parent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Files\FileManagerFolder', 'folder_id', 'unique_id');
    }

    /**
     * Get folder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function folder()
    {
        return $this->hasOne('App\Models\Files\FileManagerFolder', 'unique_id', 'folder_id');
    }

    /**
     * Get sharing attributes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shared()
    {
        return $this->hasOne('App\Models\Files\Share', 'item_id', 'unique_id');
    }
}
