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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->uuid("profileId")->default(Str::uuid())->primary();
            $table->string("userId")->nullable();
            $table->string("description")->nullable();
            $table->boolean('isProf')->default(false);
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
