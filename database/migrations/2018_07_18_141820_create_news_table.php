<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lv_id')->unsigned()->nullable();
            $table->string('author')->nullable();
            $table->string('url')->nullable();
            $table->string('content')->nullable();
            $table->date('date');
            $table->string('number');
            $table->string('title');
            $table->timestamps();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->foreign('lv_id')
                  ->references('id')->on('lvs')
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
        Schema::dropIfExists('news');
    }
}
