<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTourTable extends Migration
{
    public function up()
    {
        Schema::create('category_tour', function (Blueprint $table) {
            $table->unsignedInteger('tour_id');
            $table->unsignedInteger('category_id');

            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_tour');
    }
}
