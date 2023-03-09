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
        Schema::create('parent_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('child_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_item_id')->constrained('parent_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_items');
        Schema::dropIfExists('parent_items');
    }
};
