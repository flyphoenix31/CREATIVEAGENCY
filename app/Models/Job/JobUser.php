<?php

namespace App\Models\Job;

use ByteUnits\Metric;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Job\Job;
use Carbon\Carbon;

class JobUser extends Model
{
    use  SoftDeletes;

    protected $table = 'job_users';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'suspend_at', 'closed_at'];

    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'job_id',
        'status_id',

    ];

    public function statuses()
    {
        return ['1'=> 'active', '2' => 'completed', '3' => 'rejected', '4' => 'suspended', '5' => 'canceled'];
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('status_id', '!=' ,1);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class , 'user_id');
    }

}
