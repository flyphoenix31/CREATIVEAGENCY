<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements HasMedia
{
    use InteractsWithMedia, SoftDeletes, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'gender_id',
        'phone',
        'dob',
        'status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $sizes = [
                    'medium'  => ['name'=> 'large', 'width' => 600 ],
                    'small'   => ['name'=> 'small', 'width' => 200 ],
                    'thumb'   => ['name'=> 'thumb', 'width' => 80 ]
                ];

        foreach($sizes as $size)
        {
            $this->addMediaConversion($size['name'])
            ->width($size['width'])
            ->optimize()
            ->nonQueued();
        }
    }

    public function getThumbAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl('thumb');
        }
    }

    public function getImageAttribute()
    {
        if ($this->media->isEmpty()) {
            return asset('/images/default.png');
        } else {
            return $this->media->first()->getUrl();
        }
    }

    public function setUsernameAttribute($value){

        $this->attributes['username'] = strtolower($value);
    }

    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\User\UserStatus::class, 'status_id', 'id');
    }

    public function gender()
    {
        return $this->belongsTo(\App\Models\User\Gender::class, 'gender_id', 'id');
    }

    public function scopeExclude($query,$value = array())
    {
        return $query->select( array_diff( $this->fillable,(array) $value) );
    }

    public function scopeStatus($query, $status)
    {
        return $query = $query->where('status_id', $status );
    }

    public function scopeActive($query)
    {
        return $query->where('status_id', 1);
    }

    public function scopeIfRole($query, $role)
    {
        return $query->whereHas(
            'roles', function($q) use($role){
                $q->where('name',$role);
            });
    }

    public function scopeIsRole($query, $roles)
    {
        return $query->whereHas(
            'roles', function($q) use($roles){
                $q->whereIn('name',$roles);
            });
    }



    public function scopeFilter($query, $request)
    {
        if (!empty($request->s_username)) {
            $query = $query->where('username','LIKE', "%{$request->s_username}%") ;
        }
        if (!empty($request->s_name)) {
            $query = $query->where('name','LIKE', "%{$request->s_name}%") ;
        }
        if (!empty($request->s_email)) {
            $query = $query->where('email','LIKE', "%{$request->s_email}%") ;
        }
        if (isset($request->s_status)) {
            if ($request->s_status  != '' )
                $query = $query->where('status_id','=',$request->s_status );
        }
        if (!empty($request->s_role)) {
            $query = $query->whereHas("roles", function($q) use($request) { $q->where("id",$request->s_role ); });
        }
        return $query;
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

    public function isAdministrator()
    {
        return $this->hasRole('admin');
    }

    public function isDesigner()
    {
        //return $this->hasRole->name('designer', '');
        return $this->hasRole('designer');
    }


}
