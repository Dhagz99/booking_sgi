<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameRateTypeToReferenceNumReceiptOnTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE `transactions` CHANGE `rate_type` `reference_num_receipt` VARCHAR(255) DEFAULT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE `transactions` CHANGE `reference_num_receipt` `rate_type` VARCHAR(255) DEFAULT NULL");
    }
}
