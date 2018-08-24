<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sehir extends Model
{
    protected $table = 'sehir';
/*
    public function makaleler()
    {
        return $this->hasManyThrough('App\Makale','App\User');
    }
*/

    // Yukardaki ile aynı çıktıyı verir.Daha gelişmiştir.
    public function makaleler()
    {
        //return $this->hasManyThrough('App\VeriÇekilecekModel','App\AracıModel', 'sehir_id', 'user_id', 'id');
        return $this->hasManyThrough('App\Makale','App\User', 'sehir_id', 'user_id', 'id');
    }


}
