<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'remark',
        'status_id',
        'display_name',
        'title',
        'website'
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

    public function getCreatedAttribute()
    {
        if ($this->created_at)
        return $this->created_at->diffForHumans();
    }

    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_name)) {
            $query = $query->where('name','LIKE', "%{$request->s_name}%") ;
        }
        if (!empty($request->s_email)) {
            $query = $query->where('email','LIKE', "%{$request->s_email}%") ;
        }

        return $query;
    }
}
