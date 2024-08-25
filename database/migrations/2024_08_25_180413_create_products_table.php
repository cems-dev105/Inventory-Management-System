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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('supplier_id')->nullable();
            $table->integer('product_name');
            $table->integer('product_code')->nullable();
            $table->integer('image')->nullable();
            $table->integer('root')->nullable();
            $table->integer('buyibg_price')->nullable();
            $table->integer('selling_price');
            $table->integer('buying_date')->nullable();
            $table->integer('product_quantity');
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
