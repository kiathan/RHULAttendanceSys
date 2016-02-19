<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('lecture_instend_id')->unsigned()->index();
            $table->foreign('lecture_instend_id')->references('id')->on('lecture_instend')->onDelete('cascade');
            $table->boolean('isValit');
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
        Schema::drop('questions');
    }
}
