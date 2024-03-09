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
        Schema::create('ressource_tags', function (Blueprint $table) {
            $table->id();
            $table->uuid('ressourceId')->nullable();
            $table->uuid('tagId')->nullable();
            $table->timestamps();

            $table->foreign("ressourceId")
            ->references("ressourceId")
            ->on("ressources")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("tagId")
            ->references("tagId")
            ->on("tags")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressource_tags');
    }
};
