<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('product_name');
            $table->uuid('ypk_id');
            $table->uuid('user_id');
            $table->uuid('status_product_id');
            $table->decimal('product_cost', 9, 2);
            $table->text('product_info');
            $table->boolean('is_product');
            $table->text('photo_path')->nullable();
            $table->text('address');
            $table->timestamps();

            $table->foreign('ypk_id')->references('id')->on('ypks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_product_id')->references('id')->on('status_products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
