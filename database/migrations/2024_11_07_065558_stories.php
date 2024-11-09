<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->text('story');
            $table->string('length');
            $table->string('age');
            $table->string('language');
            $table->text('generated_story')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('story_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained();
            $table->string('style');
            $table->text('prompt');
            $table->longText('image')->nullable();
            $table->string('color')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('story_images');
        Schema::dropIfExists('stories');
    }
};
