<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwnsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('awnsers',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('question_id')->unsigned()->index();
                $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
                $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->boolean('isValit');
                $table->char('awnser');
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
        Schema::drop('awnsers');
    }
}
