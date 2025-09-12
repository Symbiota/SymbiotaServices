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
        Schema::table('contract_service', function (Blueprint $table) {
            $table->foreign(['contract_id'], 'FK_contract_pk')->references(['id'])->on('contracts')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['service_id'], 'FK_service_pk')->references(['id'])->on('services')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_service', function (Blueprint $table) {
            $table->dropForeign('FK_contract_pk');
            $table->dropForeign('FK_service_pk');
        });
    }
};
