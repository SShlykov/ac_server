<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('slug')->nullable();
            $table->bigInteger('phone');
            $table->string('locale');
            $table->string('photo')->default('https://sun9-38.userapi.com/c854320/v854320805/1b8e14/afhOhLK6rkU.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
