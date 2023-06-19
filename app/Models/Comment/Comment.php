<?php

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    //protected $appends = ['replies'];

    protected $guarded = [];

    protected $dates = ['created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function ScopeIsParent($query)
    {
        return $query->whereNull('parent_id');
    }
}
