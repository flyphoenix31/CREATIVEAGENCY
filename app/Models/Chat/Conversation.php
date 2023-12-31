<?php

namespace App\Models\Chat;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['group_id', 'from_user_id', 'message', 'file'];
}
