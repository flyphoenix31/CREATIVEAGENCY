<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'subject',
        'message',
        'is_spam',
        'is_replied',
        'is_converted',
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
