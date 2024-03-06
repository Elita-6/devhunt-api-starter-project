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
            $table->uuid('parcourId')->nullable();


            $table->foreign("parcourId")
            ->references("parcourId")
            ->on("parcours")
            ->onDelete("set null")
            ->onUpdate("cascade");

            // $table->foreignId("parcourId")
            // ->nullable()
            // ->constrained("parcours")
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
