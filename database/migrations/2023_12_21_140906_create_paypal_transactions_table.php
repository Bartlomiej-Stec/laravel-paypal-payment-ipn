<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(config('paypal.table_name'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('item');
            $table->float('amount');
            $table->string('currency_code', 3);
            $table->float('tax');
            $table->float('shipping');
            $table->string('status', 30)->default(config('paypal.default_status'));
            $additionalColumns = array_merge(config('paypal.additional_columns'), config('paypal.personal_data_columns'));
            foreach ($additionalColumns as $column) {
                $table->string($column)->nullable();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(config('paypal.table_name'));
    }
};
