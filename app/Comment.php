<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    // One To Many Polymorphic Relations (Veritabanı Çeşitlilik İlişkileri)
    // Burası yorum modeli, sitede yapılan tüm yorumlar bu tabloda kaydedilecek
    // Yorum yapılabilen Post ve Video modellerimiz bulunuyor.
    // Buradan bunların hepsine ulaşılabilecek.

    public function commentable()
    {
        return $this->morphTo();
    }
}
