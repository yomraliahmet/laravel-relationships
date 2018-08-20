<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ozgecmis extends Model
{
    protected $table= "ozgecmis";


    // Özgeçmişin ait olduğu kullanıcı bilgilerini çekiyoruz.
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Üstteki ile aynı işlemi görür, farklı olarak ilişki kurulan id kolonları da yazılır.
    /*
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    */
}


