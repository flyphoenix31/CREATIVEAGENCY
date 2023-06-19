<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{

	protected $table   = 'user_statuses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden   = ['created_at' , 'updated_at'];

}
