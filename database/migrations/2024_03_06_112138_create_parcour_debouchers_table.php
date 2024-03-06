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
        Schema::create('parcour_debouchers', function (Blueprint $table) {
            $table->id();
            $table->uuid('parcourId')->nullable();
            $table->uuid('deboucherId')->nullable();
            $table->timestamps();

            $table->foreign("parcourId")
            ->references("parcourId")
            ->on("parcours")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("deboucherId")
            ->references("deboucherId")
            ->on("debouchers")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('tech_projects', function(Blueprint $table) {
        //     $table->foreignId("parcourId")
        //     ->nullable()
        //     ->constrained("parcours")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        //     $table->foreignId("deboucherId")
        //     ->nullable()
        //     ->constrained("debouchers")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcour_debouchers');
    }
};
