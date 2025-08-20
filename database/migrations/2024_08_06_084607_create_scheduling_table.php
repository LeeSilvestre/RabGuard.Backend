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
        Schema::create('scheduling', function (Blueprint $table) {
            $table->string('classcode')->primary();
            $table->enum('class_desc',[
                'Mathematics',
                'Science',
                'Araling Panlipunan',
                'English',
                'Filipino',
                'TLE',
                'CL',
                'PE'
            ]);
            $table->string('section');
            $table->foreign('section')
            ->references('section')
            ->on('sections')
            ->onDelete('cascade');
            $table->unsignedBigInteger('adviser_id')->nullable();
            $table->foreign('adviser_id')->references('id')->on('faculty_profile');
            $table->enum('time', [
                '7 PM TO 8 AM',
                '8 AM TO 9 AM',
                '9:30 AM TO 10:30 AM',
                '10:30 AM TO 11:30 AM',
                '1 PM TO 2 PM',
                '2 PM TO 3 PM',
                '3 PM TO 4 PM',
            ]);
            $table->enum('day',[
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Weekdays'// for JHS
            ]);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduling');
    }
};
