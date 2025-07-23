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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('customer_id')->primary();
            $table->string('customer_fname');
            $table->string('customer_lname');
            $table->string('customer_mname')->nullable();
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('customer_province');
            $table->string('customer_city');
            $table->integer('customer_zip');
            $table->string('customer_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
