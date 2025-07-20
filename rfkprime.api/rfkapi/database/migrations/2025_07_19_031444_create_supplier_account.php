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
        Schema::create('supplier_information', function (Blueprint $table) {
            $table->uuid('supplier_id')->primary();
            $table->string('supplier_name');
            $table->string('brand_name');
            $table->string('supplier_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_information', function (Blueprint $table) {
            //
        });
    }
};
