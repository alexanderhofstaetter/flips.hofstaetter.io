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
            $table->integer('flips_id')->unsigned()->nullable();
            $table->string('lastname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->nullable();
            $table->string('registered_at')->nullable();
            $table->string('identification')->nullable();
            $table->string('wulogin')->nullable();
            $table->string('wupassword')->nullable();
            $table->string('profile_email')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('flips_id')
                  ->references('id')->on('flips')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
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
