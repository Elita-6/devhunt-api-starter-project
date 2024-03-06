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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->uuid('postId')->nullable();
            $table->timestamps();

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("postId")
            ->references("postId")
            ->on("posts")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('reactions', function(Blueprint $table) {
        //     $table->foreignId("postId")
        //     ->nullable()
        //     ->constrained("posts")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

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
        Schema::dropIfExists('reactions');
    }
};
