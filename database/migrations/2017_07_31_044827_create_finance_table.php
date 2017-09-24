<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('finances', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('masjid_id')->unsigned();
             $table->decimal('income', 14,2)->nullable(); // 999.999.999.999,00
             $table->decimal('expense', 14,2)->nullable(); // 999.999.999.999,00
             $table->decimal('balance', 17,2)->nullable(); // 999.999.999.999.999,00
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
         Schema::drop('finances');
     }
}
