<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission;
class PermissionModule extends Model
{
    protected $table = 'module';
    protected $fillable = ['name'];
    protected $sortable = [
    	'id', 'name', 'created_at'
    ];
    protected $hidden   = ['created_at' , 'updated_at'];
    protected $searchable = [
    	'name'
    ];

    protected $allowedFilters = [];

    public function permission()
    {
        return $this->hasMany(Permission::class, 'module_id', 'id');
    }


    public function status()
    {
        return $this->belongsTo(Permission::class, 'module_id', 'id');
    }
}
