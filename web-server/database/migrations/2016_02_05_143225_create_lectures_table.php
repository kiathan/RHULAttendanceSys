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
                $table->integer('coure_id')->unique()->index();
                $table->foreign('coure_id')->references('id')->on('coures')->onDelete('cascade');
                $table->integer('venue_id')->unique()->index();
                $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
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
