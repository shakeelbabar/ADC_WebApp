<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Registrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function(Blueprint $table){
            $table->string('student_id');
            $table->string('course_id');
            $table->string('instructor_id');
            $table->timestamps();
            $table->primary(array('student_id', 'course_id'));
            // $table->foreign('student_id')->references('reg_id')->on('students');
            // $table->foreign('course_id')->references('crs_id')->on('courses');
            // $table->foreign('instructor_id')->references('reg_id')->on('instructors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}
