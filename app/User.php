<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public function getImagePathAttribute()  # MUTATOR
    {
        if(isset($this->attributes['image']))
            return env('APP_URL') . '/storage/accounts/' . $this->attributes['image'];

        return asset('dashboard/images/profile.png');
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }



    public function has_permission($permission)
    {
        $role = $this->role;

        if($role)
        {
            $permission = $role->permissions()->where('permission_code', $permission)->first();

            if($permission)
                return true;
        }

        return false;
    }


    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_users' , 'user_id' , 'project_id');
    }



    public function my_projects()
    {
        return $this->hasMany(Project::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
