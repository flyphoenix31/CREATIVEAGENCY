<?php

namespace App\Models\Job;

use ByteUnits\Metric;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Job\JobCategory;
use App\Models\Job\JobUser;
use App\Models\Job\JobDistribution;
use App\Models\Job\JobRejected;
use Carbon\Carbon;

class Job extends Model
{

    use Searchable, SoftDeletes, Sluggable;

    protected $table      = 'freelance_jobs';

    protected $appends = ['slugurl'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

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
        'title',
        'slug',
        'short_description',
        'full_description',
        'job_nature',
        'is_featured',
        'is_urgent',
        'status_id',
        'type_id',
        'min_budget',
        'budget',
        'view_count',
        'delivery_day',
        'tags',

    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $name = Str::slug($array['title'], ' ');

        return [
            'id'         => $this->id,
            'name'       => $name,
            'nameNgrams' => utf8_encode((new TNTIndexer)->buildTrigrams(implode(', ', [$name]))),
        ];
    }

    public function getSlugUrlAttribute() {



        $user = \Auth::user();
        if($user->hasRole('designer') )
        {
            return route('designer_view_job', ['slug' => $this->attributes['slug']]);
        }

        return route('view_job', ['slug' => $this->attributes['slug']]);
    }

    public function ScopeIsid($query, $id)
    {
        return $query->where('id',  $id);
    }

    public function ScopeActive($query)
    {
        return $query->where('status_id',  1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('status_id', '!=' ,1);
    }

    public function ScopeIsSlug($query, $slug)
    {
        return $query->where('slug',  $slug);
    }

    public function ScopeCheckUserAccess($query)
    {
        $user = \Auth::user();
        if($user->hasRole('designer') )
        {
            //return $query->whereHas('jobuser', function($q) use($user) {
            //    $q->where('user_id',  $user->id);
            //});
        }


    }



    public function ScopeIsKeywords($query, $value)
    {
        if($value)
            return $query->where('title', 'LIKE', '%'.$value.'%')
            ->orWhere('full_description', 'LIKE', '%'.$value.'%');
    }

    public function ScopeIsCategory($query, $cat)
    {
        //dd($cat);

        if (!empty($cat))
        {
            return $query->whereHas('categories', function($q) use($cat) {
                $q->whereIn('id',  $cat);
            });
        }
            //return $query->whereIn('slug',  $slug);
    }

    public function ScopeJobTypes($query, $value)
    {
        if($value)
            return $query->whereIn('job_nature',  $value);
    }

    public function ScopePostDate($query, $value)
    {
        $date = null;
        switch($value)
        {
            case(1):
                $date = Carbon::now()->subHours(1);
            break;
            case(2):
                $date = Carbon::now()->subHours(24);
            break;
            case(3):
                $date = Carbon::now()->subDays(7);
            break;
            case(4):
                $date = Carbon::now()->subDays(14);
            break;
            case(5):
                $date = Carbon::now()->subDays(30);
            break;
        }
       // dd($date);

        if ($date)
            return $query-> where('created_at', '>=', $date);
    }

    public function ScopeBudget($query, $min = null, $max = null)
    {
        if (!empty($min) && !empty($max))
        {
            return $query->whereBetween(\DB::raw('budget'), [$min, $max]);
        }
        elseif (!empty($min))
        {
            return $query->whereRaw("budget >= ?", $min);
        }
        elseif (!empty($max))
        {
            return $query->whereRaw('budget <= ?', $max);
        }
    }

    public function distributionlist()
    {
        return $this->hasMany(JobDistribution::class , 'job_id');
    }

    public function categories()
    {
        return $this->hasMany(JobCategory::class , 'job_id');
    }

    public function jobuser()
    {
        return $this->hasone(JobUser::class , 'job_id');
    }

    public function ackuser()
    {
        return $this->belongsTo(JobUser::class , 'job_id');
    }

    public function active_jobuser() {
        return $this->jobuser()->where('status_id','=', 1);
    }

    public function active_jobuser_history() {
        return $this->jobuser()->where('status_id','!=', 1);
    }

    public function rejected()
    {
        //return $this->belongsTo(JobRejected::class , 'job_id');
        return $this->hasOne(JobRejected::class , 'job_id');
    }




}
