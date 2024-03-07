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
        Schema::create('courses', function (Blueprint $table) {
            // $table->uuid("courseId")->default(Str::uuid())->primary();
            $table->uuid("courseId")->primary();
            $table->string("courseName")->nullable();
            $table->string("courseDescription")->nullable();
            $table->dateTime("sendingDate")->useCurrent();
            $table->string("courseUrl")->useCurrent();
            $table->string("fileType")->nullable();
            $table->string("userId")->nullable();
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('courses', function(Blueprint $table) {
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
        Schema::dropIfExists('courses');
    }
};
