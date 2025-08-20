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
        Schema::create('alumni_profile', function (Blueprint $table) {

            $table->string('student_id', 11)->primary();
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->string('batch');
            $table->string('yearGraduated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni_profile');
    }
};
