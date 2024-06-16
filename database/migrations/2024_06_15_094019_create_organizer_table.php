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
            $table->string('name');
            $table->integer('rate')->default(0);
            $table->integer('hired')->default(0);	;
            $table->string('location');
            $table->string('specialist');
            $table->string('services');
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
