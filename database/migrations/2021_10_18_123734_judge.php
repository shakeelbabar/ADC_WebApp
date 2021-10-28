<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Judge extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judges', function(Blueprint $table){
            $table->id();
            $table->string('reg_id');
            $table->string('role');
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
        Schema::dropIfExists('judges');
    }
}


// INSERT INTO `judges` (`id`, `reg_id`, `role`, `created_at`, `updated_at`) VALUES
// (NULL, 'INS-101', 'Jury1', '2021-10-18 17:43:36', '2021-10-18 17:43:36'),
// (NULL, 'INS-200', 'Jury2', '2021-10-18 17:43:36', '2021-10-18 17:43:36'),
// (NULL, 'STF-001', 'Jury3', '2021-10-18 17:43:36', '2021-10-18 17:43:36')