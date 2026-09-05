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
        Schema::create('room', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('room_number')->nullable();
            $table->unsignedBigInteger('room_type_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('rate_type')->nullable();
            $table->string('room_rate')->nullable();
            $table->string('no_of_person')->nullable();
            $table->string('adult_rate')->nullable();
            $table->string('children_rate')->nullable();
            $table->foreign('room_type_id')->references('room_type_id')->on('room_type');
            $table->foreign('status_id')->references('status_id')->on('room_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
