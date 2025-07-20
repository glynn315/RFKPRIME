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
            $table->uuid('product_id')->primary();
            $table->uuid('supplier_id');
            $table->string('product_name');
            $table->string('product_volume');
            $table->string('product_quantity');
            $table->string('product_pricepc');
            $table->string('product_pricebulk');
            $table->string('product_status');
            $table->timestamps();


            $table->foreign('supplier_id')->references('supplier_id')->on('supplier_information');
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
