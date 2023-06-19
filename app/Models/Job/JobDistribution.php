<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Job\Job;

class JobDistribution extends Model
{

    protected $table    = 'job_distribution_list';

    protected $guarded = ['id'];

    public $timestamps = FALSE;

    protected $appends = ['category'];

    protected $fillable = [
        'job_id',
        'user_id',
        'role_id',
        'type_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class , 'user_id');
    }



}
