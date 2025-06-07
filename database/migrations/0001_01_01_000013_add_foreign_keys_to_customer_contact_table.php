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
        Schema::table('customer_contact', function (Blueprint $table) {
            $table->foreign(['contact_id'], 'FK_contact_pk')->references(['id'])->on('contacts')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['customer_id'], 'FK_customer_pk')->references(['id'])->on('customers')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_contact', function (Blueprint $table) {
            $table->dropForeign('FK_contact_pk');
            $table->dropForeign('FK_customer_pk');
        });
    }
};
