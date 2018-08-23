<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Urun extends Model
{
    protected $table = 'urun';

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    /*
    // üstteki ile aynı sonucu verir, daha detaylıdır.Detayı Şudur:
    // laravel urun ve user tablolarımızın ortak tablosunun ismini "urun_user" olarak kabul eder
    // eğer farklı bir tablo ismi ile kullanmak istersek o zaman buradaki gibi kullanmalıyız.
    // "urun_id" ve "user_id" içinde aynı mantık geçerli
    public function user()
    {
        return $this->belongsToMany('App\User','urun_user','urun_id','user_id');
    }
    */
}
