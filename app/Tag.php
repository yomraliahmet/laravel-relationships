<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    // Tagdan, bu tagı kullanan tüm postlara ulaşıyoruz
    public function posts()
    {
        return $this->morphedByMany('App\Post', 'taggable');
    }

    // Tagdan bu tagı kullanan tüm videoları kullanıyoruz
    public function videos()
    {
        return $this->morphedByMany('App\Video', 'taggable');
    }
}
