<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViolationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('violations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cases_id'); // Foreign key column
            $table->string('student_ID');
            $table->string('student_name')->nullable();
            $table->string('case_title');
            $table->text('case_description');
            $table->string('case_sanction');
            $table->boolean('case_status')->default(0); // 0 for not-cleared, 1 for cleared
            $table->date('case_date')->nullable();
            $table->timestamps();

            // Set up the foreign key constraint
            $table->foreign('cases_id')
                  ->references('cases_id') // Ensure this matches the primary key in the 'cases' table
                  ->on('cases')
                  ->onDelete('cascade'); // Optional: Automatically delete violations if the related case is deleted
        });
    }

    public function down(): void
    {
        Schema::table('violations', function (Blueprint $table) {
            // Drop the foreign key constraint before dropping the column
            $table->dropForeign(['cases_id']);
        });

        Schema::dropIfExists('violations');
    }
}
