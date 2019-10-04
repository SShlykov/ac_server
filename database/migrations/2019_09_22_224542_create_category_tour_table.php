<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTourTable extends Migration
{
    public function up()
    {
        Schema::create('category_tour', function (Blueprint $table) {
            $table->integer('tour_id');
            $table->integer('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_tour');
    }
}
