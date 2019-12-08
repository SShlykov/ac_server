<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPhotosTable extends Migration
{
    public function up()
    {
        Schema::create('carphotos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('car_photo_front');
            $table->string('car_photo_side');
            $table->string('car_photo_back');
            $table->timestamps();
            $table->unsignedInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('carphotos', function (Blueprint $table) {
            $table->dropForeign('carphotos_car_id_foreign');
        });
        Schema::dropIfExists('carphotos');
    }
}
