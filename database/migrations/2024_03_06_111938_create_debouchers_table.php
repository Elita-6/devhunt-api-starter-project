<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('debouchers', function (Blueprint $table) {
            // $table->uuid("deboucherId")->default(Str::uuid())->primary();
            $table->uuid("deboucherId")->primary();
            $table->string("deboucherName")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debouchers');
    }
};
