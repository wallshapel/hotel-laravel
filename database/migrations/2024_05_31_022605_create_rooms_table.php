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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable(false);
            $table->unsignedBigInteger('room_type_id');
            $table->unsignedBigInteger('hotel_id');
            $table->smallInteger('capacity')->nullable(false)->unsigned();
            $table->timestamps();

            // Foreign key constraints with cascade actions
            $table->foreign('room_type_id')
                  ->references('id')->on('room_types')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('hotel_id')
                  ->references('id')->on('hotels')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
