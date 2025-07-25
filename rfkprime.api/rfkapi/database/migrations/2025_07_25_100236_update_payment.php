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
        Schema::table('payments', function (Blueprint $table) {
            $table->string('cart_id');
            $table->dropColumn('order_id');

            $table->foreign('cart_id')->references('cart_id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('cart_id');
            $table->dropColumn('order_id');

            $table->foreign('cart_id')->references('cart_id')->on('carts');
        });
    }
};
