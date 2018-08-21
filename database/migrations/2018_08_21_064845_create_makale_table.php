<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makale', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // unsigned() 0 dan yukarı değerlerin girilmesine izin verir, - değerlere izin vermez.
            $table->integer('user_id')->unsigned();
            $table->string('baslik',250)->nullable();
            $table->string('detay',250)->nullable();

            /**
             * ->foreign('user_id')     => "makale" tablosundaki "user_id" kolunu.
             * ->references('id')       => "user" tablosundaki "id" kolunu.
             * ->on('users')            => "user" tablosu.
             * ->onDelete('cascade')    => silindiğinde palılacak işlem.
             */

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
        Schema::dropIfExists('makale');
    }
}
