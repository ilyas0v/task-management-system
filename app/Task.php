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



    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    public function belongs_to_me()
    {
        $current_user = \Auth::user();
        $owner_id = $this->user_id;

        return $current_user->id == $owner_id;
    }



    public function completed_users()
    {
        return $this->belongsToMany(User::class, 'task_completes', 'task_id', 'user_id');
    }


    public function completed_user_ids()
    {
        $ids = [];

        $users = $this->completed_users;

        foreach($users as $user)
            $ids[] = $user->id;


        return $ids;
    }


    public function completed_by_me()
    {
        $completed = $this->completed_users()->where('user_id', \Auth::user()->id)->first();

        return (bool) $completed;
    }
}
