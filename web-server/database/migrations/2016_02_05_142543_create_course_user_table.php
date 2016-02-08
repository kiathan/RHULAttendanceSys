<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unique()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('coure_id')->unique()->index();
            $table->foreign('coure_id')->references('id')->on('coures')->onDelete('cascade');
            $table->enum('role', [""]);
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
        Schema::drop('course_user');
    }
}
