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

    // Accessors - Veri çekerken kolon değerleri üzerinde işlem yapmayı sağlar.
    public function getTitleAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    // Mutators - Veri kaydederken kolon değerleri üzerinde işlem yapmayı sdağlar.
    public function setTitleAttribute($value)
    {
        $this->attributes['name'] = mb_strtoupper($value, "UTF-8");
    }
}
