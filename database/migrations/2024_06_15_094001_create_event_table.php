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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');
            $table->string('name');
            $table->string('initiator');
            $table->string('organizer');
            $table->string('location');
            $table->string('category');
            $table->string('theme')->nullable();
            $table->string('description');
            $table->string('scale');
            $table->boolean('app');
            $table->bigInteger('price');
            $table->integer('rate')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};