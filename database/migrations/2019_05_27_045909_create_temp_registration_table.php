<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_registration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from', 255)->nullable();
            $table->string('token', 255);
            $table->string('email', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('information', 255)->nullable();
            $table->timestamp('expiration')->nullable();
            $table->integer('locked')->default(0);
            $table->integer('deleted_flg')->default(0);
            $table->timestamp('deleted_at')->useCurrent();
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
        Schema::dropIfExists('temp_registration');
    }
}
