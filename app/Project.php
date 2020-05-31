<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users', 'project_id', 'user_id');
    }

    public function user_ids()
    {
        $user_ids = [];

        $users = $this->users;

        if($users)
        {
            foreach($users as $user)
            {
                $user_ids[] = $user->id;
            }
        }

        return $user_ids;
    }



    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }
}
