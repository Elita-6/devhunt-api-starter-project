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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid("eventId")->default(Str::uuid())->primary();
            $table->string("eventTitle")->nullable();
            $table->text("eventDescription")->nullable();
            $table->dateTime("dateEvent");
            $table->string("userId")->nullable();
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Created by a user
        // Schema::table('events', function(Blueprint $table) {
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
        Schema::dropIfExists('events');
    }
};
