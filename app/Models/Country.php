<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public $table = 'country_new';

    protected $fillable = [
        'is_active'
    ];



    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }


    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_name)) {
            $query = $query->where('country','LIKE', "%{$request->s_name}%") ;
        }
        if (isset($request->s_status)) {
            if ($request->s_status  != '' )
                $query = $query->where('status_id','=',$request->s_status );
        }

        return $query;
    }

}
