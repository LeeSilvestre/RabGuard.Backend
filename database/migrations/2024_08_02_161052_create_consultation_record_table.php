<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_record', function (Blueprint $table) {
            $table->id(); // auto-incrementing ID
            $table->string('student_id', 11);
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->string('complaint')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('oxygen_sat')->nullable();
            $table->string('temp')->nullable();
            $table->text('treatment')->nullable();
            // Adjust this line if `medicine_id` is no longer relevant:
            $table->unsignedBigInteger('medicine_id')->nullable(); // medicine_id can be null
            $table->timestamp('time_in')->nullable(); // stores date and time
            $table->timestamp('time_out')->nullable(); // Fixed typo
            $table->boolean('is_timeout')->default(false); // stores boolean value

            // Foreign key constraints (if applicable)
            // Uncomment and adjust if needed:
            // $table->foreign('student_id')->references('student_id')->on('student_profile')->onDelete('set null');
            // $table->foreign('medicine_id')->references('id')->on('medicine')->onDelete('set null');

            $table->timestamps(); // creates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation_record');
    }
}
