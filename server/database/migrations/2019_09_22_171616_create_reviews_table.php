<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('text', 500);
            $table->tinyInteger('rating');
            $table->unsignedInteger('driver_id');

            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('rewiews_driver_id_foreign');
        });
        Schema::dropIfExists('reviews');
    }
}

