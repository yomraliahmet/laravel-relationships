<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // Kullanıcının özgeçmişine bire bir (one to one) ilişki mantığında bu şekilde ulaşıyoruz.
    public function ozgecmis()
    {
        return $this->hasOne('App\Ozgecmis');
    }



    // Yukarıdaki yazmın biraz daha gelişmişidir.
    /**
     * 1. Parametre : İlişki kurulacak model adı.
     * 2. Parametre : İlişki kurulan modeldeki ilişkili "id".(user_id, rol_id v.b.)
     * 3. Parametre : İlişki kuran modelin "id" si.
     */

    /*
    public function ozgecmis()
    {
        //return $this->hasOne('App\OrnekModel','ornekmodel_id','buradaki_id');
        return $this->hasOne('App\Ozgecmis','user_id','id');
    }
    */


    // Bu modelin ismini alıp sonuna "_id" ekleyerek verileri bu şekilde çekebiliyor.
    // Bu durum ilişki kurulan tablodaki ilişki "id" si ile eşleşme olursa gerekleşir.
    public function makaleler()
    {
        return $this->hasMany('App\Makale');
    }


/*  // üstteki ile aynı sonucu verim biraz daha gelişmiştir.
    public function makaleler()
    {
        return $this->hasMany('App\Makale','user_id','id');
    }
 */

    // çoka çok ilişki bu şekilde yazılıyor.
    /*
    public function urunler()
    {
        return $this->belongsToMany('App\Urun');
    }
*/
    // üstteki ile aynı sonucu verir, daha gelişmişidir.
    public function urunler()
    {
        //return $this->belongsToMany('App\Modeladi','ara_tablo','user_id','urun_id');
        return $this->belongsToMany('App\Urun','urun_user','user_id','urun_id');
    }

}
