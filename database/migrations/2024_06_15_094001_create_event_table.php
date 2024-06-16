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
            $table->string('initiator')->nullable();
            $table->string('organizer')->nullable();
            $table->string('location');
            $table->string('category');
            $table->string('theme')->nullable();
            $table->string('description');
            $table->string('scale');
            $table->boolean('app');
            $table->bigInteger('price');
            $table->bigInteger('budget');
            $table->integer('rate')->nullable();
            $table->boolean('public')->nullable();
            $table->boolean('done')->nullable();
            
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
