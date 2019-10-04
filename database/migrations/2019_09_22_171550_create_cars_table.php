<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type', ['Седан', 'Внедорожник', 'Минивэн', 'Хэтчбэк']);
            $table->integer('sits');
            $table->enum('fuel', ['Бензин', 'Дизель', 'Газ']);
            $table->integer('price');
            $table->boolean('child');
            $table->unsignedInteger('driver_id');
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_driver_id_foreign');
        });
        Schema::dropIfExists('cars');
    }
}
