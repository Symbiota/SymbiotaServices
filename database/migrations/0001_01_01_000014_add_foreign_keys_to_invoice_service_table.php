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
        Schema::table('invoice_service', function (Blueprint $table) {
            $table->foreign(['service_id'], 'FK_invoice_service_pk')->references(['id'])->on('services')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['invoice_id'], 'FK_invoice_pk')->references(['id'])->on('invoices')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_service', function (Blueprint $table) {
            $table->dropForeign('FK_invoice_service_pk');
            $table->dropForeign('FK_invoice_pk');
        });
    }
};
