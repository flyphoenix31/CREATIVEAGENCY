<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group_name', 'description'];


    public function users()
    {
        return $this->hasOne('App\Models\Chat\GroupUser');
    }

    public function groupUsers()
    {
        return $this->hasMany('App\Models\Chat\GroupUser');
    }

}
