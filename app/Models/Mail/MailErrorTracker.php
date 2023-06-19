<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailErrorTracker extends Model
{
    protected $table = 'mail_error_tracker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'user_id',
        'model',
        'model_id',
        'email',
        'error_data',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getCreatedAttribute()
    {
        if ($this->created_at)
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->account_id)) {
            $query = $query->where('account_id',  $request->account_id ) ;
        }

        return $query;
    }
}
