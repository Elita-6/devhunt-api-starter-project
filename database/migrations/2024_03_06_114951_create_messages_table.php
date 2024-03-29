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
        Schema::create('messages', function (Blueprint $table) {
            // $table->uuid("messageId")->default(Str::uuid())->primary();
            $table->uuid("messageId")->primary();
            $table->string("messageContent")->nullable();
            $table->boolean("isBot")->nullable();
            $table->uuid("discussionId")->nullable();
            $table->timestamps();

            $table->foreign("discussionId")
            ->references("discussionId")
            ->on("discussions")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
