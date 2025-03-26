<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); 
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('tags')->nullable(); // Tags can be comma-separated strings
            $table->decimal('product_weight', 8, 2)->nullable();
            $table->boolean('new_arrivals')->default(0); // 1 for new arrivals, 0 for not
            $table->boolean('featured')->default(0); // 1 for featured, 0 for not
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->string('image_4')->nullable();
            $table->tinyInteger('status')->default(1); // 1 for active, 0 for inactive
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('focus_keywords')->nullable();
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
