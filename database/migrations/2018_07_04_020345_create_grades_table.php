<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->float('points_max', 10, 2)->nullable();
            $table->float('points_sum', 10, 2)->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('title')->nullable();
            $table->string('comments')->nullable();
            $table->dateTime('date')->nullable();
            $table->dateTime('entry_date')->nullable();
            $table->string('source_id')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lv_id')->unsigned()->nullable();
            $table->foreign('lv_id')
                  ->references('id')->on('lvs')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
