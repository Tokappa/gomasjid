<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('masjid_id')->unsigned();
            $table->unsignedInteger('album_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('masjid_id')->references('id')->on('masjids')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('album_id')->references('id')->on('albums')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album_schedules');
    }
}
