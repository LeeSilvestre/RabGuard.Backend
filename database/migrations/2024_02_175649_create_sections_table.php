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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('grade_level', 2);
            $table->string('section')->unique();
            $table->enum('strand', ['STEM',  'ABM',  'HUMSS', 'GAS', 'HE', 'N/A'])->default('N/A');
            $table->unsignedBigInteger('adviser_id');
            $table->foreign('adviser_id')->references('id')->on('faculty_profile');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
