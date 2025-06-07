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
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->foreign(['item_id'], 'FK_invoice_item_pk')->references(['id'])->on('items')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['invoice_id'], 'FK_invoice_pk')->references(['id'])->on('invoices')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropForeign('FK_invoice_item_pk');
            $table->dropForeign('FK_invoice_pk');
        });
    }
};
