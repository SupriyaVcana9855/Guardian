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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('service_type')->nullable();
            $table->string('description_1')->nullable();
            $table->string('description_2')->nullable();
            $table->string('button_content')->nullable();
            $table->string('button_link')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_color')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();

            $table->string('show_on_home_page')->nullable();

            $table->json('pointers')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
