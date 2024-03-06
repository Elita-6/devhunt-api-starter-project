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
        Schema::table('user_profiles', function(Blueprint $table) {
            $table->string('porteId')->nullable();

            $table->foreign("porteId")
            ->references("porteId")
            ->on("portes")
            ->onDelete("set null")
            ->onUpdate("cascade");

            // $table->foreignId("porteId")
            // ->nullable()
            // ->constrained("portes")
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
