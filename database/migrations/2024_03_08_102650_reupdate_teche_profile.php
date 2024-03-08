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
        //
        Schema::create('profile_teches', function (Blueprint $table) {

            $table->id();
            $table->uuid("profileId")->nullable();
            $table->uuid("technologyId")->nullable();
            $table->timestamps();

            $table->foreign("profileId")
                ->references("profileId")
                ->on("user_profiles")
                ->onDelete("set null")
                ->onUpdate("cascade");

            $table->foreign("technologyId")
                ->references("technologyId")
                ->on("technologies")
                ->onDelete("set null")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
