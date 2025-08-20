<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_family_infos', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 11);
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->string('father_name', 50)->nullable(false);
            $table->string('father_occupation', 50)->nullable(false);
            $table->string('father_mobileno', 11)->nullable(false);
            $table->string('mother_name', 50)->nullable(true);
            $table->string('mother_occupation', 50)->nullable(true);
            $table->string('mother_mobileno', 11)->nullable(true);
            $table->string('guardian_name', 50)->nullable(true);
            $table->string('guardian_occupation', 50)->nullable(true);
            $table->string('guardian_mobileno', 11)->nullable(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_family_info');
    }
};
