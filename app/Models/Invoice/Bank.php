<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $table = 'invoice_bank_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'account_number',
        'bank_name',
        'bank_code',
        'bank_country',
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


    public function scopeFilter($query, $request)
    {
        return $query;
    }

}
