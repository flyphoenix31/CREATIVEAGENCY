<?php

namespace App\Models\Mail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailDailyCount extends Model
{
    protected $table = 'mail_daily_count';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'send_date',
        'type',
        'account_id',
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
