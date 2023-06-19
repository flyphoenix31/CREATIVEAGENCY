<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;


class Gender extends Model
{


    protected $table = 'gender_statuses';
    protected $fillable = ['name'];
    protected $sortable = [
        'id', 'name', 'created_at','color'
    ];
    protected $hidden   = ['created_at' , 'updated_at'];
    protected $searchable = [
        'name'
    ];

    protected $allowedFilters = [];
}
