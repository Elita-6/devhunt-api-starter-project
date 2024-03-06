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
        Schema::create('participers', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->uuid('eventId')->nullable();
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("eventId")
            ->references("eventId")
            ->on("events")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Pivot entre user et events, participation
        // Schema::table('participers', function(Blueprint $table) {
        //     $table->foreignId("eventId")
        //     ->nullable()
        //     ->constrained("events")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        //     $table->foreignId('userId')
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
        Schema::dropIfExists('participers');
    }
};
