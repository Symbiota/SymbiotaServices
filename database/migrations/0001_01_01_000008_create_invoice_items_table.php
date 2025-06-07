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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->nullable()->index('fk_invoice_pk');
            $table->unsignedInteger('item_id')->nullable()->index('fk_invoice_item_pk');
            $table->string('type', 50)->nullable();
            $table->decimal('qty', 20, 3)->nullable();
            $table->date('date_calculated')->nullable();
            $table->decimal('amount_owed', 20, 3)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
