<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $fillable = [
        'body', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
