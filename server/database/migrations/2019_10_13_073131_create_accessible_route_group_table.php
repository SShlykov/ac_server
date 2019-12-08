<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessibleRouteGroupTable extends Migration
{
    public function up()
    {
        Schema::create('accessible_route_group', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_group_id');
            $table->timestamps();

            $table->foreign('route_group_id')->references('id')->on('route_group')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('accessible_route_group');
    }
}
