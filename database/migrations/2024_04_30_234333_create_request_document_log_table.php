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
        
        Schema::create('request_document_log', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('remarks')->nullable(true);
            $table->string('action_by', 11);
            $table->foreignId('request_id')->constrained('request_document')->onDelete('cascade');
            $table->timestamp('action_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_document_log');
    }
};
