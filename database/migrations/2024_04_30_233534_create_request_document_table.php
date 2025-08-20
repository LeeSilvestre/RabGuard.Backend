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
        Schema::create('request_document', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 11);
            $table->foreign('student_id')->references('student_id')->on('student_profilings')->onDelete('cascade');
            $table->enum('requested_by',['Relative', 'Student'])->default('Student');
            $table->string('gurdian_name');
            $table->enum('document_type', ['Form 137-A(TOR/SF10)', 'Diploma', 'Report Card(F-138)(CTC)', 'Good Moral Certificate', 'Enrollment Certificate','ESC Certificate', 'Completion Certificate', 'English as Medium Ins.', 'With Honors Certificate', 'GWA Certificate', 'Others'])->default('Others');
            $table->string('document_remarks')->nullable(true);
            $table->string('document_request_date');
            $table->string('document_release_date')->nullable(true);
            $table->string('purpose')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_document');
    }
};
