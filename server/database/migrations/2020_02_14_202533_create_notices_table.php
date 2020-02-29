<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->string('client_mail');
            $table->string('client_phone');
            $table->string('client_address');
            $table->string('transfer_date');
            $table->string('transfer_time');
            $table->string('transfer_route');
            $table->integer('transfer_price');
            $table->string('driver_name');
            $table->integer('driver_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
