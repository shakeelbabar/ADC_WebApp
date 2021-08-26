<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AttendanceRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_records', function(Blueprint $table){
            $table->string('student_id');
            $table->string('course_id');
            $table->integer('presents');
            $table->integer('absents');
            $table->timestamps();
            $table->primary(array('student_id', 'course_id'));
            // $table->foreign('student_id')->references('reg_id')->on('students');
            // $table->foreign('course_id')->references('crs_id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance_records');
    }
}
