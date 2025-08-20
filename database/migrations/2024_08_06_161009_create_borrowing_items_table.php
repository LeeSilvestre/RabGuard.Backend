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
        Schema::create('borrowing_items', function (Blueprint $table) {
            $table->unsignedBigInteger('rooms_id')->nullable();
            $table->foreign('rooms_id')->references('id')->on('Rooms')->onDelete('cascade');
            $table->unsignedBigInteger('borrowers_id')->nullable();
            $table->foreign('borrowers_id')->references('id')->on('Borrowers')->onDelete('cascade');
            $table->id();
            $table->date('date_borrowed');
            $table->date('date_return');
            $table->enum('status', ['borrowed', 'returned']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_items');
    }
};
