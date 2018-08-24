<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Kullanıcının özgeçmişine ulaşıyoruz.
Route::get('/user', function () {
    $user = App\User::with('ozgecmis')->with('makaleler')->with('urunler')->where('id',2)->firstOrFail();

    echo "---------------------- Özgeçmiş Bilgileri --------------------------<br><br>";
    echo "id : ".$user->id."<br>";
    echo "name : ".$user->name."<br>";
    echo "email : ".$user->email."<br>";
    echo "<br><br><br>";
    echo "---------------------- Makale Bilgileri --------------------------<br><br>";



    foreach($user->makaleler as $makale){
        echo "başlık : ". $makale->baslik."<br>";
        echo "detay : ".$makale->detay."<br><hr>";
    }


    echo "<br><br><br>";
    echo "---------------------- Ürünler --------------------------<br><br>";

    foreach($user->urunler as $urun){
        echo "urun adi : ".$urun->urunadi."<br>";
        echo "urun adet : ".$urun->adet."<br>";
        echo "urun fiyat : ".$urun->fiyat."<br><hr>";
    }

});

// Özgeçmişin ait olduğu kullanıcının bilgilerini çekiyoruz.
Route::get('/ozgecmis', function(){
    $ozgecmis = App\Ozgecmis::with('user')->where('id',1)->firstOrFail();

    echo "id : ".$ozgecmis->id."<br>";
    echo "isim : ".$ozgecmis->isim."<br>";
    echo "soyisim : ".$ozgecmis->soyisim."<br>";
    echo "sehir : ".$ozgecmis->sehir."<br>";
    echo "meslek : ".$ozgecmis->meslek."<br>";

});

Route::get('/makale', function(){
    $makale = App\Makale::with('user')->where('id',2)->firstOrFail();

    echo "baslik : ". $makale->baslik."<br>";
    echo "name : ". $makale->user->name."<br>";
    echo "email : ". $makale->user->email."<br>";
});

Route::get('/urun', function(){

    $urun = App\Urun::with(['user' => function($query){
        // Tekrarlayan kayıtları teke düşürüyoruz.
        $query->distinct('id');

        // Kullanıcıya ait ilgili üründen kaç tane var onu buluyoruz.

        $query->withCount(['urunler' => function($query2){
            $query2->where('urun_id',15);
        }]);

    }])->where('id',15)->firstOrFail();

    foreach($urun->user as $user){
        echo "user id : ". $user->id."<br>";
        echo "name : ". $user->name."<br>";
        echo "email : ". $user->email."<br>";
        echo "toplam urun : ". $user->urunler_count."<br><hr>";
    }

});

Route::get('/urun2',function(){
    $urun = DB::table('urun_user')
    ->select('user_id','urun_id','users.name as username')
    ->addSelect(DB::raw('count(user_id) as user_count'))
    ->groupBy('user_id')
    ->join('users','users.id','=','user_id')
    ->where('urun_id',15)->get();

   foreach($urun as $u){
    echo $u->username."  (".$u->user_count.")<br><hr>";
   }

});


