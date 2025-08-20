<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_cert', function (Blueprint $table) {
            $table->id();
            $table->date('date_created');
            $table->string('name');
            $table->string('school_id')->nullable();
            $table->date('birthdate');
            $table->string('age');
            $table->string('blood_pressure');
            $table->string('pulse_rate');
            $table->string('vision_left');
            $table->string('vision_right');
            $table->string('weight');
            $table->string('height');
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
        Schema::dropIfExists('medical_cert');
    }
}
