<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJumatTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('jumat', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('masjid_id')->unsigned();
             $table->string('muadzin', 255)->nullable();
             $table->string('khatib', 255)->nullable();
             $table->string('imam', 255)->nullable();
             $table->timestamps();
             $table->softDeletes();
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('jumat');
     }
}
