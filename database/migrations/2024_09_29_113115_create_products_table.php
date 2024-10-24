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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->foreignUuid('thumbnail')->constrained('media')->cascadeOnDelete();
            $table->json('product_galleries')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('stock')->default(1);
            $table->char('weight', 50);
            $table->float('discount')->nullable();
            $table->foreignUuid('category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->foreignUuid('sub_category_id')->nullable()->constrained('sub_categories')->cascadeOnDelete();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
