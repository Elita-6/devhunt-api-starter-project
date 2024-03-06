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
        Schema::create('images', function (Blueprint $table) {
            $table->uuid("imageId")->default(Str::uuid())->primary();
            $table->string("imageUrl")->nullable();
            $table->uuid("postId")->nullable();
            $table->uuid("eventId")->nullable();
            $table->timestamps();

            $table->foreign("postId")
            ->references("postId")
            ->on("posts")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("eventId")
            ->references("eventId")
            ->on("events")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('images', function(Blueprint $table) {
        //     $table->foreignId("postId")
        //     ->nullable()
        //     ->constrained("posts")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        //     $table->foreignId("eventId")
        //     ->nullable()
        //     ->constrained("events")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
