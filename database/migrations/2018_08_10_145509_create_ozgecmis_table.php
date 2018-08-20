<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOzgecmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ozgecmis', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            $table->increments('id');

            // unsigned() 0 dan yukarı değerlerin girilmesine izin verir, - değerlere izin vermez.
            // unique() bire bir (one to one) ilişki olacağından, aynı "user_id" değerinden başka bir kayıt olmamalıdır.
            $table->integer('users_id')->unsigned()->unique();

            $table->string('isim',25)->nullable();
            $table->string('soyisim',25)->nullable();
            $table->string('sehir',25)->nullable();
            $table->string('meslek',25)->nullable();

            // Burası ilişkiyi sağlayan kısım, burada diyoruz ki;
            // "ozgecmis" tablosundaki "user_id" alanı "users" tablosundaki "id" alanına eşittir, bağlıdır..
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ozgecmis');
    }
}
