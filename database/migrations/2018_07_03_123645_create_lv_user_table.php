<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLvUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lv_user', function (Blueprint $table) {
            $table->integer('lv_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->unique(['lv_id', 'user_id']);
            $table->timestamps();
        });

        Schema::table('lv_user', function (Blueprint $table) {
            $table->foreign('lv_id')->references('id')->on('rolvsles')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
                  
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('lv_user');
    }
}
