<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('status_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_products');
    }
};
