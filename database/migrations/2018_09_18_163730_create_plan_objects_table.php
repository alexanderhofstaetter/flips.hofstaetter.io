<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('internal_id');
            $table->string('name');
            $table->integer('order');
            $table->string('type');
            $table->string('attempts')->nullable();
            $table->string('attempts_max')->nullable();
            $table->string('lv_url')->nullable();
            $table->string('lv_status')->nullable();
            $table->string('depth');
            $table->date('date')->nullable();
            $table->string('result')->nullable();
            $table->timestamps();
        });

        Schema::table('plan_objects', function (Blueprint $table) {
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
        Schema::dropIfExists('plan_objects');
    }
}
