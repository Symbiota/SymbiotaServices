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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('billing_start')->nullable();
            $table->date('billing_end')->nullable();
            $table->decimal('amount_billed', 20, 3)->nullable();
            $table->dateTime('date_invoiced')->nullable();
            $table->dateTime('date_paid')->nullable();
            $table->mediumText('notes')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
