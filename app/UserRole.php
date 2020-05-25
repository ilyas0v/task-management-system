<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions' , 'role_id', 'permission_id');
    }


    public function permission_ids()
    {
        $permissions = $this->permissions;

        $permission_ids = [];

        if(count($permissions) > 0)
            foreach($permissions as $p)
                $permission_ids[] = $p->id;

        return $permission_ids;
    }
}
