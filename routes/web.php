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

Route::get('/sehir-kullanici-makale', function(){
    $makale = App\Sehir::with('makaleler')->find(61);

    foreach($makale->makaleler as $m){
        echo "başlık : ". $m->baslik."<br>";
        echo "detay : ". $m->detay."<br><hr>";
    }
});

// Post dan yorumlara ulaşıyoruz
Route::get('/post-comments', function(){
    $post = App\Post::find(5);

    foreach($post->comments as $comment){
        echo "comment id : ". $comment->id."<br>";
        echo "comment : ". $comment->body."<br><hr>";
    }
});

// Video dan yorumlara ulaşıyoruz
Route::get('/video-comments', function(){
    $video = App\Video::find(7);

    foreach($video->comments as $comment){
        echo "comment id : ". $comment->id."<br>";
        echo "comment : ". $comment->body."<br><hr>";
    }
});

// Yorumun nereye ait olduğunu buluyoruz, hangi post yede video ise ona..
Route::get('/comment', function(){
    $comment = App\Comment::find(1);

    $commentable = $comment->commentable;

    dd($comment);
});

// Posta ait tagları çekiyoruz.
Route::get('/post-tags', function(){
    $post = App\Post::find(10);
    foreach($post->tags as $tags){
        echo "tag : ". $tags->title."<br>";
    }
});

// Tagın ait olduğu videoları listeliyoruz.
Route::get('/tags-video', function(){
    $tag = App\Tag::find(3);

    foreach($tag->videos as $video){
        echo "title : ".$video->title."<br>";
    }
});


// Kullanıcıya ait aktif olan postaları çekiyoruz.
Route::get('/user-posts', function(){
    $user = App\User::find(1);

    $posts = $user->posts()->where('active',1)->get();
    dd($posts);
});

// Kullanıcıya ait tüm postları listeliyoruz.
Route::get('/user-posts1', function(){
    $user = App\User::find(1);

    foreach($user->posts as $post){
        echo 'title : '. $post->title."<br>";
        echo 'body : '. $post->body."<br><hr>";
    }
});

// Yorumu bulunan postları getirir.
Route::get('/posts', function(){
    $posts = App\Post::has('comments')->get();
    dd($posts);
});

// Toplam yorum sayısı 2 ve yukarısında olan kayıtları çeker.
Route::get('/posts1', function(){
    $posts = App\Post::has('comments', '>=', 2)->get();
    dd($posts);
});

// Postlartında yorum bulunan kullanıcıları çeker.
Route::get('/user-posts2', function(){
    $user = App\User::has('posts.comments')->get();
    dd($user);
});

// Yorumunda aranan kelime ile eşleşen postlar çekiliyor..
Route::get('/posts3', function(){
    $posts = App\Post::whereHas('comments', function($query){
        $query->where('body','like','%Qui%');
    })->get();
    dd($posts);
});

// Yorumu bulunmayan postları getirir.
Route::get('/posts4', function(){
    $posts = App\Post::doesntHave('comments')->get();
    dd($posts);
});

// Yorumunda aranan kelime bulunmayan postlar çekiliyor.
Route::get('/posts5', function(){
    $posts = App\Post::whereDoesntHave('comments', function($query){
        $query->where('body','like','%Qui%');
    })->get();
    dd($posts);
});


// Posta ait toplam yorum sayılarını da çeker
Route::get('/posts6', function(){
    $posts = App\Post::withCount('comments')->get();
    //dd($posts);

    foreach ($posts as $post) {
        echo $post->comments_count."<br>";
    }
});


// Posta yorumlaraında arama yapar bulunan kayıtları, kayıt sayıları ile çeker.
Route::get('/posts7', function(){
    $posts = App\Post::whereHas('comments', function($query){
        $query->where('body','like','%Qui%');
    })->withCount('comments')->get();

    dd($posts);
});


// Yorum ekleniyor "save()" metodu ile.
Route::get('/insert-comment', function(){
    $comment = new App\Comment(['body' => 'Merhaba bu benim ilk yorumum..']);
    $post = App\Post::find(1);
    $post->comments()->save($comment);
});

// Birden fazla yorum ekleniyor "saveMany()" metodu ile.
Route::get('/insert-comment1', function(){
    $post = App\Post::find(1);
    $post->comments()->saveMany([
        new App\Comment(['body' => 'Merhaba Dünya']),
        new App\Comment(['body' => 'Hello World']),
    ]);
});
