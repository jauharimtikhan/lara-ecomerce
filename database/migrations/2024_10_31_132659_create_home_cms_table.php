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
        Schema::create('home_cms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('home_banner')->nullable();
            $table->json('home_brand')->nullable();
            $table->json('home_category')->nullable();
            $table->json('home_ads')->nullable();
            $table->json('home_footer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_cms');
    }
};
