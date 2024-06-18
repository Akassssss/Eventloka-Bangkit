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
        Schema::create('organizer', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userId');
            $table->string('email');
            $table->string('name')->nullable();
            $table->float('rate')->default(0);
            $table->float('eventRate')->default(0);
            $table->integer('hired')->default(0);	
            $table->string('location')->nullable();
            $table->string('categorySpecialist')->nullable();
            $table->integer('scaleSpecialist')->nullable();
            $table->string('services')->nullable();
            $table->integer('experience')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizer');
    }
};
