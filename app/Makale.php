<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makale extends Model
{
    protected $table = "makale";

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    */

}
