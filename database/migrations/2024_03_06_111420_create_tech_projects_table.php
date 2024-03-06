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
        Schema::create('tech_projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('technologyId')->nullable();
            $table->uuid('projectId')->nullable();
            $table->timestamps();

            $table->foreign("technologyId")
            ->references("technologyId")
            ->on("technologies")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("projectId")
            ->references("projectId")
            ->on("projects")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('tech_projects', function(Blueprint $table) {
        //     $table->foreignId("technologyId")
        //     ->nullable()
        //     ->constrained("technologies")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        //     $table->foreignId("projects")
        //     ->nullable()
        //     ->constrained("projectId")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_projects');
    }
};
