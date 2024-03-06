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
        Schema::create('itineraires', function (Blueprint $table) {
            $table->string("itineraireId")->default(Str::uuid())->primary();
            $table->string("design")->nullable();
            $table->uuid("profileId")->nullable();
            $table->timestamps();


            $table->foreign("profileId")
            ->references("profileId")
            ->on("user_profiles")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });

        // Schema::table('itineraires', function(Blueprint $table) {
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
        Schema::dropIfExists('itineraires');
    }
};
