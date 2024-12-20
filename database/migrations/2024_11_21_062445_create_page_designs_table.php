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
        Schema::create('page_designs', function (Blueprint $table) {
            $table->id();
            $table->text('category')->nullable();
            $table->text('font_size')->nullable();
            $table->text('font_weight')->nullable();
            $table->text('content_color')->nullable();
            $table->string('text_alignment')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_designs');
    }
};
