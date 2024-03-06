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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->uuid("commentId")->default(Str::uuid())->primary();
            $table->string("content")->nullable();
            $table->string("userId")->nullable();
            $table->uuid("postId")->nullable();
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

        // Schema::table('commentaires', function(Blueprint $table) {
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
        Schema::dropIfExists('commentaires');
    }
};
