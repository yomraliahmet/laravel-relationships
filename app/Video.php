<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    // Yorumlara ulaşıyoruz
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
