<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMakeupExamApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makeup_exam_applications', function (Blueprint $table) {
            $table->id();
            $table->string('case_id');
            $table->string('student_id');
            $table->string('course_id');
            $table->string('instructor_id');
            $table->string('term');
            $table->string('reason');
            $table->string('status');
            $table->string('remarks');
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
        Schema::dropIfExists('makeup_exam_applications');
    }
}
