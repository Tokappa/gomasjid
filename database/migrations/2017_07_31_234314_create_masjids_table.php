<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasjidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('masjids', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('user_id')->unsigned();
		     $table->string('contact_name', 100)->nullable();
		     $table->string('contact_phone', 100)->nullable();
             $table->string('address')->nullable();
             $table->decimal('lat', 9,6)->nullable();
             $table->decimal('lon', 9,6)->nullable();
             $table->decimal('alt', 6,2)->nullable();
             $table->text('fine_tune')->nullable();
             $table->enum('convention', ['mwlg', 'isna', 'egas', 'uqum', 'uisk'])->default('egas');
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
         Schema::drop('masjids');
     }
}
