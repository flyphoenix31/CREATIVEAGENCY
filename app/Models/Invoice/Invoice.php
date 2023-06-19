<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Invoice extends Model implements HasMedia
{

    use SoftDeletes, InteractsWithMedia;

    public $table = 'invoice_master';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'invoice_number',
        'invoice_date',
        'due_date',
        'customer_id',
        'business_name',
        'address_1',
        'address_2',
        'phone',
        'email',
        'additional_info',
        'notes',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'total_discount',
        'total_tax',
        'sub_total',
        'tax_type_id',
        'user_id',
        'currency_id'
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

    protected $appends = ['thumb','image'];

    public function getImageAttribute()
    {
        if ($this->media->isEmpty()) {
            return $this->pic;
        } else {
            return $this->media->first()->getUrl();
        }
    }

    public function getPicAttribute()
    {
        $record = \App\Models\Setting\Setting::first();

        return $record->image;
    }

    public function getGlobalThumbAttribute()
    {
        $record = \App\Models\Setting\Setting::first();

        return $record->thumb;
    }

    public function getThumbAttribute()
    {
        if ($this->media->isEmpty()) {
            return $this->globalthumb;
        } else {
            return $this->media->first()->getUrl('thumb');
        }
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $sizes = [
                    'large'   => ['name'=> 'large', 'width' => 1300 ],
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



    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->name)) {
            $query = $query->where('client_name','LIKE', "%{$request->name}%") ;
        }
        if (!empty($request->email)) {
            $query = $query->where('client_email','LIKE', "%{$request->email}%") ;
        }

        return $query;
    }

    public function items()
    {
        return $this->hasMany(\App\Models\Invoice\Items::class, 'invoice_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo(\App\Models\Invoice\Bank::class, 'id', 'invoice_id');
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Invoice\InvoiceStatus::class, 'status_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(\App\Models\Currency::class, 'currency_id', 'id');
    }

}
