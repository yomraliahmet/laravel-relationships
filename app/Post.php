<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    // Yorumlara ulaşıyoruz.
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    // posta ait tüm taglara ulaşıyoruz.
    public function tags()
    {
        return $this->morphToMany('App\Tag','taggable');
    }
}
