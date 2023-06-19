<?php

namespace App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Job\Category;

class JobCategory extends Model
{

    protected $table    = 'job_category';

    protected $guarded = ['id'];

    public $timestamps = FALSE;

    protected $appends = ['category'];

    protected $fillable = [
        'job_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsto(Category::class);
    }


}
