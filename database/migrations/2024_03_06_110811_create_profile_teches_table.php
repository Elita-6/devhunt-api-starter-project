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
        Schema::create('profile_teches', function (Blueprint $table) {
            $table->id();
            $table->uuid("profileId")->nullable();
            $table->string("userId")->nullable();
            $table->timestamps();


            $table->foreign("profileId")
            ->references("profileId")
            ->on("user_profiles")
            ->onDelete("set null")
            ->onUpdate("cascade");

            $table->foreign("userId")
            ->references("userId")
            ->on("users")
            ->onDelete("set null")
            ->onUpdate("cascade");
        });


        // Schema::table('profile_teches', function(Blueprint $table) {
        //     $table->foreignId("profileId")
        //     ->nullable()
        //     ->constrained("user_profiles", "profileId")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();

        //     $table->foreignId("users")
        //     ->nullable()
        //     ->constrained("userId", "userId")
        //     ->nullOnDelete()
        //     ->cascadeOnUpdate();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_teches');
    }
};
