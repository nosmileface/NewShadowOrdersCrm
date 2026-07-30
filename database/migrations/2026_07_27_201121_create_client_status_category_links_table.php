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
        Schema::create('client_status_category_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_status_category_id')->constrained('client_status_categories')->cascadeOnDelete();
            $table->unsignedBigInteger('stageable_id');
            $table->string('stageable_type');
            $table->timestamps();

            // Index
            $table->index(['stageable_id', 'stageable_type']);

            // Unique
            $table->unique(['client_status_category_id', 'stageable_id', 'stageable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_status_category_links');
    }
};
