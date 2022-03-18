<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Meetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->string('case_id');
            $table->string('meeting_id');
            $table->string('topic');
            $table->string('status');
            $table->string('start_url')->nullable();
            $table->string('join_url');
            $table->string('password');
            $table->string('start_time');
            $table->string('duration');
            $table->timestamps();

            $table->primary(['case_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
