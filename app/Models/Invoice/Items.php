<?php

namespace App\Models\Invoice;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{


    public $table = 'invoice_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'description',
        'item_notes',
        'unit_price',
        'quantity',
        'sub_total',
        'has_tax',
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
