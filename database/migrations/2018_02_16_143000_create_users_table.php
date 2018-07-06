<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->string('wuregistered_at')->nullable();
            $table->string('wuidentification')->nullable();
            $table->string('wulogin')->nullable();
            $table->string('wupassword')->nullable();
            $table->string('wuemail')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
