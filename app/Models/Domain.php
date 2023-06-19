<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Domain extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hosting_provider_name',
        'customer_name',
        'reg_at',
        'expire_at',
        'status_id',
        'remark',
        'is_autorenew'
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

    protected $dates = ['reg_at', 'expire_at', 'created_at', 'updated_at'];

    public function getCreatedAttribute()
    {
        if ($this->created_at)
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        // && strtotime($this->expire_at) > strtotime(now())

        if( strtotime($this->expire_at) < strtotime('+30 days') && strtotime($this->expire_at) > strtotime(now()) ) {
            // this is true
                return $this->status = 'expiring';
        }
        elseif( strtotime($this->expire_at) < strtotime(now()) ) {
            return $this->status = 'expired';
        }


    }

    public function scopeIsId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_name)) {
            $query = $query->where('name','LIKE', "%{$request->s_name}%") ;
        }
        if (!empty($request->s_hosting_name)) {
            $query = $query->where('hosting_name','LIKE', "%{$request->s_hosting_name}%") ;
        }
        if (!empty($request->s_customer_name)) {
            $query = $query->where('customer_name','LIKE', "%{$request->s_customer_name}%") ;
        }
        if (!empty($request->showexpiringitems)) {
            $now = Carbon::now();
            $newdate = date('Y-m-d H:i:s', strtotime ( '+1 month' , strtotime ( $now ) ) ); //add 1 month to $now

            $newdate = Carbon::now()->addDays(30);


            $query = $query->whereBetween('expire_at', [$now, $newdate] );


            //$query = $query->whereDate('expire_at', '>', Carbon::now()->addDays(30));
        }



        return $query;
    }
}
