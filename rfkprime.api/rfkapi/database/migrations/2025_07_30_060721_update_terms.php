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
        Schema::table('terms', function (Blueprint $table) {
            $table->decimal('amount','8','2');
            $table->date('schedule_date');
            $table->date('payment_date');
            $table->string('payment_status');
            $table->unsignedBigInteger('payment_id');

            $table->foreign('payment_id')->references('payment_id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('terms', function (Blueprint $table) {
            //
        });
    }
};
