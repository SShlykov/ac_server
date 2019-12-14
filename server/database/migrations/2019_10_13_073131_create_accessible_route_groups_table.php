<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessibleRouteGroupsTable extends Migration

{
    public function up()
    {
        Schema::create('accessible_route_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('route_group_id_1');
            $table->unsignedInteger('route_group_id_2');
            $table->timestamps();

            $table->foreign('route_group_id_1')->references('id')->on('route_groups')->onDelete('cascade');
            $table->foreign('route_group_id_2')->references('id')->on('route_groups')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('accessible_route_groups');
    }
}
