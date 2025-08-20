<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('item_quantity')->default(0);
            $table->string('category');
            $table->string('unit_of_measure');
            $table->string('room_number');
            $table->string('school_level');
            $table->string('acceptedby');
            $table->integer('borrowed_items')->default(0);
            $table->integer('overdue_items')->default(0);
            $table->integer('damaged_items')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
