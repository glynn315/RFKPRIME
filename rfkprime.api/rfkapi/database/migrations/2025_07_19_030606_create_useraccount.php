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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->uuid('user_id')->primary();
            $table->string('user_fname');
            $table->string('user_mname');
            $table->string('user_lname');
            $table->string('user_province');
            $table->string('user_city');
            $table->integer('user_zip');
            $table->string('user_status');
            $table->string('user_username')->unique();
            $table->string('user_password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            //
        });
    }
};
