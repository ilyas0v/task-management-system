<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }


    public function comments()
    {
        return $this->hasMany(NewsComment::class, 'news_id');
    }



    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }



    public function scopeOrdering($query)
    {
        return $query->orderBy('created_at', 'DESC');
    }
}
