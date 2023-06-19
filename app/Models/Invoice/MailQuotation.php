<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailQuotation extends Model
{
    use SoftDeletes;

    public $table = 'mailed_quotation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'subject',
        'mail_content',
        'to_email',
        'view_count',
        'status_id',
        'public_link',
        'user_id'
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

    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }



    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_email)) {
            $query = $query->where('to_email','LIKE', "%{$request->s_email}%") ;
        }

        return $query;
    }

    public function scopeInvoice($query)
    {
        return $this->belongsTo(\App\Models\Invoice\Invoice::class, 'invoice_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
