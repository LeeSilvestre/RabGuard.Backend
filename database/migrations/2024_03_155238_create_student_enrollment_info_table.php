<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('student_enrollment_info', function (Blueprint $table) {
        $table->unsignedBigInteger('enrollment_recno')->primary();
        $table->string('student_id', 11)->nullable();
        $table->foreign('student_id')->references('student_id')->on('student_profilings');
        $table->string('student_lrn', 12)->nullable();
        $table->foreign('student_lrn')->references('student_lrn')->on('student_profilings')->onDelete('cascade');
        $table->integer('year');
        $table->string('strand');
        $table->integer('grade_level');
        $table->string('section');
        $table->unsignedBigInteger('adviser_id');
        $table->foreign('adviser_id')->references('id')->on('faculty_profile');
        $table->string('enrollment_status');
        $table->date('enrollment_date');
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollment_info');
    }
};
