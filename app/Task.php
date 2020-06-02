<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $dates = [
        'deadline'
    ];



    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function assigned_users()
    {
        return $this->belongsToMany(User::class, 'task_assignments', 'task_id', 'user_id');
    }


    public function assigned_user_ids()
    {
        $ids = [];

        $users = $this->assigned_users;

        foreach($users as $user)
            $ids[] = $user->id;


        return $ids;
    }



    public function comments()
    {
        return $this->hasMany(TaskComment::class, 'task_id');
    }
}
