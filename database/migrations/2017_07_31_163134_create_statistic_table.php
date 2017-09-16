<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatisticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('masjid_id')->unsigned();
            $table->smallInteger('status')->default(0); // On / Off
            // $table->string('uptime', 100)->nullable();
            $table->string('temperature', 50)->nullable();
            $table->string('total_space', 50)->nullable();
            $table->string('used_space', 50)->nullable();
            $table->string('free_space', 50)->nullable();
            $table->string('used_space_perc', 50)->nullable();
            $table->string('bandwidth', 200)->nullable();
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
        //
        Schema::drop('statistics');
    }
}
