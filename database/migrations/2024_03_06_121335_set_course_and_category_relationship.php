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
        Schema::table('courses', function(Blueprint $table) {
            $table->uuid('categoryId')->nullable();

            $table->foreign("categoryId")
            ->references("categoryId")
            ->on("categories")
            ->onDelete("set null")
            ->onUpdate("cascade");

            // $table->foreignId("categoryId")
            // ->nullable()
            // ->constrained("categories")
            // ->nullOnDelete()
            // ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
