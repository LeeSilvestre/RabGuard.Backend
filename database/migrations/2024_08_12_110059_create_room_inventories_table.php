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
        Schema::create('room_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rooms_id')->nullable();
            $table->foreign('rooms_id')->references('id')->on('Rooms')->onDelete('cascade');
            $table->unsignedBigInteger('items_id')->nullable();
            $table->foreign('items_id')->references('id')->on('Items')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_inventories');
    }
};
