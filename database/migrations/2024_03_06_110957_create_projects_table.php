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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid("projectId")->default(Str::uuid())->primary();
            $table->string("title")->nullable();
            $table->string("projectDescription")->nullable();
            $table->dateTime("startDate")->nullable();
            $table->dateTime("endDate")->nullable();
            $table->string("userId")->nullable();
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Profile relationship
        // Schema::table('projects', function(Blueprint $table) {
        //     $table->foreignId("userId")
        //     ->nullable()
        //     ->constrained("users")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
