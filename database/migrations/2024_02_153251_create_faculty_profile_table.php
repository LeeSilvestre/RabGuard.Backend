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
        Schema::create('faculty_profile', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname')->nullable(true);
            $table->string('lname');
            $table->string('extension')->nullable(true);
            $table->string('email')->unique();
            $table->string('contact_no');
            $table->enum('position',['Faculty', 'Adviser'])->default('Faculty');
            $table->enum('department',[
                'Mathematics',
                'Science',
                'Araling Panlipunan',
                'English',
                'Filipino',
                'TLE',
                'CL',
                'PE'
            ]);
            $table->string('region')->nullable(true);
            $table->string('province')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('barangay')->nullable(true);
            $table->string('street')->nullable(true);
            $table->string('zip_code')->nullable(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty_profile');
    }
};
