<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Job\Job;

class JobRejected extends Model
{

    protected $table    = 'job_user_rejected';

    protected $guarded = ['id'];

    //public $timestamps = FALSE;

    protected $appends = ['category'];

    protected $fillable = [
        'job_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class , 'user_id');
    }



}
