<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalExaminationsTable extends Migration
{
    public function up()
    {
        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 11);
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->string('blood_pressure');
            $table->string('pulse_rate');
            $table->string('vision_left');
            $table->string('vision_right');
            $table->string('height');
            $table->string('weight');
            $table->string('cl');
            $table->string('abdomen');
            $table->string('extremities');
            $table->string('skin');
            $table->string('cvs');
            $table->text('personal_family_history');
            $table->text('remarks');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('physical_examinations');
    }
};
