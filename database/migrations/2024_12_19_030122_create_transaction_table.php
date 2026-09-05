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
        Schema::create('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('folio_number')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('room_id')->nullable();
            $table->date('date_in')->nullable();
            $table->string('rate_type')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->integer('no_of_adults')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->unsignedBigInteger('business_source_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->date('date_out')->nullable();
            $table->decimal('rate_period', 10, 2)->nullable();
            $table->decimal('total_charges', 10, 2)->nullable();
            $table->decimal('other_charges', 10, 2)->nullable();
            $table->decimal('sub_total', 10, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->nullable();
            $table->decimal('balance', 10, 2)->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_plate_no')->nullable();
            $table->string('bank')->nullable();
            $table->string('card_type')->nullable();
            $table->string('reference_num')->nullable();
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
