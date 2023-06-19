<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailAccount extends Model
{
    protected $table = 'mail_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mail_driver',
        'mail_host',
        'mail_username',
        'mail_password',
        'mail_port',
        'mail_enc',
        'is_default',
        'display_name',
        'from_address',
        'from_name'
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
            $query = $query->where('display_name','LIKE', "%{$request->s_name}%") ;
        }

        return $query;
    }
}
