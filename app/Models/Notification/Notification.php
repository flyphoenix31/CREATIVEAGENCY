<?php
namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Notification extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $table    = 'notifications';

    protected $fillable = ['user_id', 'type_id', 'subject', 'content', 'is_read'];

    protected $dates    = ['created_at', 'updated_at'];

    protected $hidden   = ['deleted_at', 'updated_at', 'user_id'];

    protected $appends  = ['image', 'created'];

    //protected $with = ['gen'];

    protected function getimageAttribute()
    {

            if ($this->gen)
            {
                if ($this->gen->thumb) {
                    return $this->gen->thumb;
                }
            }

            return $this->pic;
    }

    public function getPicAttribute()
    {
        return asset('/images/default_notification.png');
    }

    public function getCreatedAttribute()
    {
        if ($this->created_at)
            return $this->created_at->diffForHumans();
    }

    public function getTypeAttribute()
    {
        switch($this->type_id)
        {
            case(1):
                return '<i data-feather="bell" class="text-danger"></i>';
            break;
            case(2):
                return '<i data-feather="database"></i>';
            break;
            case(3):
                return '<i data-feather="file"></i>';
            break;
            case(4):
                return '<i data-feather="align-left"></i>';
            break;
        }


        if ($this->type_id)
            return $this->created_at->diffForHumans();
    }

    public function scopeIsUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeIsRead($query)
    {
        return $query->where('is_read', 1);
    }

    public function scopeIsUnRead($query)
    {
        return $query->where('is_read', 0);
    }

    public function scopeIsType($query, $type)
    {
        if(!empty($type))
            return $query->where('type', $type);
    }

}
