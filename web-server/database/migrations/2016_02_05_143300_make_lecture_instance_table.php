<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLectureInstanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecture_instend', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('lecture_id')->unsigned()->index();
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->boolean('isActive');
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
        Schema::drop('lecture_instend');
    }
}
