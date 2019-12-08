<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTourTable extends Migration
{
    public function up()
    {
        Schema::create('route_tour', function (Blueprint $table) {
            $table->increments('order');
            $table->unsignedInteger('tour_id');
            $table->unsignedInteger('route_id');

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_tour');
    }
}
