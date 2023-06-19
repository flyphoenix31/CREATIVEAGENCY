<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{

    protected $table    = 'category_list';

    protected $guarded  = ['id'];

    public $timestamps = FALSE;

    protected $fillable = [
        'parent_id',
        'name',
    ];


}
