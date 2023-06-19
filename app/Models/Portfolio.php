<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Portfolio extends Model implements HasMedia
{

    use SoftDeletes, InteractsWithMedia;

    public $table = 'portfolio';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag',
        'title',
        'sub_title',
        'is_featured',
        'content',
        'status_id',
        'slug_url'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['thumb','image', 'banner', 'bannerthumb'];

    public function getCreatedAttribute()
    {
        if ($this->created_at)
            return $this->created_at->diffForHumans();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $sizes = [
                    'large'   => ['name'=> 'large', 'width' => 1300 ],
                    'medium'  => ['name'=> 'medium', 'width' => 600 ],
                    'thumb'  => ['name'=> 'thumb', 'width' => 200 ],
                ];

        foreach($sizes as $size)
        {
            $this->addMediaConversion($size['name'])
            ->width($size['width'])
            ->optimize()
            ->nonQueued();
        }
    }

    public function getImageAttribute()
    {
        if ($this->media->isEmpty()) {
            return $this->pic;
        } else {
            return $this->media->where('collection_name', 'portfolio_image')->first()->getUrl();
        }
    }

    public function getThumbAttribute()
    {

        if ($this->media->isEmpty()) {
            return $this->pic;
        } else {
            return $this->media->where('collection_name', 'portfolio_image')->first()->getUrl('thumb');
        }
    }

    public function getBannerAttribute()
    {
        if ($this->media->isEmpty()) {
            return $this->pic;
        } else {
            return $this->media->where('collection_name', 'portfolio_banner')->first()->getUrl();
        }
    }

    public function getBannerThumbAttribute()
    {

        if ($this->media->isEmpty()) {
            return $this->pic;
        } else {
            return $this->media->where('collection_name', 'portfolio_banner')->first()->getUrl('thumb');
        }
    }

    public function getPicAttribute()
    {
        return 'https://via.placeholder.com/200x150?text=No+Image';
    }

    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->name)) {
            $query = $query->where('name','LIKE', "%{$request->name}%") ;
        }
        if (!empty($request->s_email)) {
            $query = $query->where('email','LIKE', "%{$request->s_email}%") ;
        }

        return $query;
    }

}
