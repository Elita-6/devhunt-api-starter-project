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
        Schema::create('experiences', function (Blueprint $table) {
            $table->uuid("experienceId")->default(Str::uuid())->primary();
            $table->string("experienceTitle");
            $table->string("experienceDescription");
            $table->dateTime("dateStart")->nullable();
            $table->dateTime("dateEnd")->nullable();
            $table->uuid("profileId")->nullable();
            $table->timestamps();

            $table->foreign("profileId")
            ->references("profileId")
            ->on("user_profiles")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('experiences', function(Blueprint $table) {
        //     $table->foreignId("profileId")
        //     ->nullable()
        //     ->constrained("user_profiles")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
