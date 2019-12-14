<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteRouteGroupTable extends Migration
{
    public function up()
    {
        Schema::create('route_route_group', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_group_id');
            $table->unsignedInteger('route_id');
            $table->timestamps();

            $table->foreign('route_group_id')->references('id')->on('route_groups')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('route_route_group');
    }
}
