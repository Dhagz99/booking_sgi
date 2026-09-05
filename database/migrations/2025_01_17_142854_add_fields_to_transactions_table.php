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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('added_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->datetime('time_checkin')->nullable();
            $table->datetime('time_checkout')->nullable();
            $table->string('client_current_status')->nullable();
            $table->decimal('amount_discounted', 10, 2)->nullable();
            $table->integer('no_of_sc_pwd')->nullable();
            $table->integer('bod_discount_type')->nullable();
            $table->integer('bod_no_of_sc_pwd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn(['added_by', 'updated_by', 'time_checkin', 'time_checkout', 'amount_discounted']);
        });
    }
};
