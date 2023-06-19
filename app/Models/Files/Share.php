<?php

namespace App\Models\Files;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Comment\Comment;

class Share extends Model
{

    protected $table    = 'file_shares';

    protected $guarded = ['id'];

    protected $appends = ['link', 'expired'];

    protected $dates = ['created_at'];

    /**
     * Generate share link
     *
     * @return string
     */
    public function getLinkAttribute() {

        return url('/shared', ['token' => $this->attributes['token']]);
    }

    public function getExpiredAttribute()
    {
        if (Carbon::parse(now())->greaterThan($this->attributes['expire_at']) == TRUE)
        {
            return TRUE;
        }

        return FALSE;

        if (Carbon::parse($this->attributes['expire_at']) < Carbon::now()) {
            return true;
        }
        return false;
    }

    public function getExpiredBadgeAttribute()
    {
        if ($this->attributes['expire_at'] == NULL)
        {
            return '<span class="badge badge-success"> Never Expire </span>';
        }
        elseif (Carbon::parse(now())->greaterThan($this->attributes['expire_at']) == TRUE)
        {
            return '<span class="badge badge-danger"> Yes </span>';
        }

        return '<span class="badge badge-primary"> No </span>';
    }

    public function getProtectedBadgeAttribute()
    {
        if ($this->attributes['protected'] == TRUE)
        {
            return '<span class="badge badge-success"> Yes </span>';
        }

        return '<span class="badge badge-dark"> No </span>';
    }

    public function getProtectedAttribute()
    {
        if ($this->attributes['protected'] == TRUE)
        {
            return TRUE;
        }

        return FALSE;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

}
