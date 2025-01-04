<?php

use App\Models\User;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable()->default(null);
            $table->date('wedding_date')->nullable()->default(null);
            $table->string('venue_name')->nullable()->default(null); 
            $table->string('venue_address')->nullable()->default(null);
            $table->decimal('latitude', 10, 7)->nullable()->default(null); // Google Maps
            $table->decimal('longitude', 10, 7)->nullable()->default(null); // Google Maps
            $table->string('theme')->nullable()->default(null);
            $table->decimal('estimated_cost', 10, 2)->nullable()->default(null);
            $table->string('dress_code')->nullable()->default(null); 
            $table->string('food_options')->nullable()->default(null); 
            $table->date('rsvp_deadline')->nullable()->default(null); 
            $table->text('transportation_notes')->nullable()->default(null);
            $table->text('gifts')->nullable()->default(null); 
            $table->string('music_type')->nullable()->default(null); 
            $table->string('host')->nullable()->default(null); 
            $table->boolean('with_children')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
