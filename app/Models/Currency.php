<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

    public $table = 'country_currency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'symbol',
        'country_name',
        'due_date',
        'is_active',
        'img'
    ];



    public $timestamps = false;

    public function getThumbAttribute()
    {
        if ($this->media->isEmpty()) {
            return $this->globalthumb;
        } else {
            return $this->media->first()->getUrl('thumb');
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_name)) {
            $query = $query->where('country_name','LIKE', "%{$request->s_name}%") ;
        }
        if (!empty($request->s_status))
        {
            if($request->s_status == 1)
            {
                $query = $query->where('is_active','=', 1 );
            }
            elseif($request->s_status == 2)
            {
                $query = $query->where('is_active','!=', 1 );
            }
        }

        return $query;
    }

}
