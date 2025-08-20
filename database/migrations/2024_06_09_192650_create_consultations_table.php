<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->string('student_id', 11);
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->id('con_id');
            $table->string('con_title');
            $table->text('con_notes');
            // $table->string('con_title');
            $table->enum('con_status',['ARCHIVED',  'UNARCHIVED'])->default('UNARCHIVED');
            $table->timestamp('con_date')->nullable();
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
        Schema::dropIfExists('consultations');
    }
}
