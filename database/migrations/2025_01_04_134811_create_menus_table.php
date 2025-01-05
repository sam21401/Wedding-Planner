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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete(); // Reference to posts table
            $table->string('dish_name'); // Name of the dish
            $table->string('dish_type'); // Type of dish (e.g., Starter, Main, Dessert)
            $table->string('options')->nullable(); // Options for the dish (e.g., Vegetarian, Vegan, Gluten-Free)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
