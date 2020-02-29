<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverRouteGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_route_group', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_group_id');
            $table->unsignedInteger('driver_id');

            $table->foreign('route_group_id')->references('id')->on('route_groups')->onDelete('restrict');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_route_group');
    }
}
