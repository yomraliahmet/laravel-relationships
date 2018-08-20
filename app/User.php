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


}
