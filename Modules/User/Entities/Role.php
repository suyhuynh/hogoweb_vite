<?php

namespace Modules\User\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\User\Repositories\Permission;
use Modules\App\Entities\AppModel;
class Role extends AppModel
{
    protected $fillable = array(
        'title',
        'department_id',
        'position_id',
        'user_id',
        'permissions',
        'created_by',
        'updated_at',
        'created_at' 
    );
    // protected $casts = [
    //     'permissions' => 'array',
    // ];
    protected static function boot() {
        parent::boot();
        static::saving(function (self $role) {
            if (request()->has('permissions')) {
                $role->permissions = implode(',', request()->permissions);
            }
        });
    }
    public function search($request)
    {
        $query = $this->newQuery()->withoutGlobalScopes();
        if(!empty($keyword = array_get(request()->all(), 'keyword'))){
            $query = $query->where('title', 'like', '%'.$keyword.'%');
        }
        return $query;
    }

    public function department() {
        return $this->hasOne('Modules\User\Entities\Department', 'id', 'department_id');
    }

    public function position() {
        return $this->hasOne('Modules\User\Entities\Position', 'id', 'position_id');
    }

    public function getMapData($role)
    {
        return [
            'department_title' => @$role->department->title,
            'position_title' => @$role->position->title,
        ];
    }
}
