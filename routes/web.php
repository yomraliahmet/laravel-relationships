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
    $user = App\User::with('ozgecmis')->with('makaleler')->where('id',2)->firstOrFail();

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



