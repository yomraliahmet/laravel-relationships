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

Route::get('/user', function () {
    $user = App\User::with('ozgecmis')->firstOrFail();

    echo "id : ".$user->id."<br>";
    echo "name : ".$user->name."<br>";
    echo "email : ".$user->email."<br>";

});
