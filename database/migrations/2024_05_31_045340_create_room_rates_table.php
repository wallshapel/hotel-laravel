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
        Schema::create('room_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('season_id');
            $table->decimal('price', 8, 2)->nullable(false)->unsigned();
            $table->timestamps();

            // Foreign key constraints with cascade actions
            $table->foreign('room_id')
                  ->references('id')->on('rooms')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('season_id')
                  ->references('id')->on('seasons')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_rates');
    }
};
