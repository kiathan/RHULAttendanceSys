<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('course_id')->unsigned()->index();
                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
                $table->integer('venue_id')->unsigned()->index();
                $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
                $table->enum('dayofweek', array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"));
                $table->time('starttime');
                $table->time('endtime');
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
        Schema::drop('lectures');
    }
}
