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
        Schema::table('posts', function(Blueprint $table) {
            $table->uuid('archiveId')->nullable();

            $table->foreign("archiveId")
            ->references("archiveId")
            ->on("archives")
            ->onDelete("set null")
            ->onUpdate("cascade");


            // $table->foreignId("archiveId")
            // ->nullable()
            // ->constrained("archives")
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
