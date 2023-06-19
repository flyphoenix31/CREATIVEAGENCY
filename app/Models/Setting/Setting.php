<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table     = 'settings';

    protected $fillable  = ['account_number', 'bank_name', 'bank_code', 'bank_country', 'site_logo'
    ];

    protected $appends = [
        'image', 'thumb', 'imagepath'
    ];


    public static function getTableName()
    {
        return with(new static)->getTable();
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
            ->optimize()
            ->nonQueued();
        }
    }

    public function getImagePathAttribute()
    {
        return $this->media->first()->getPath();
    }

    public function getThumbAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl('thumb');
        }
    }

    public function getImageAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl();
        }
    }

}
