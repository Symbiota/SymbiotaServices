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
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign('FK_contract_customer_pk');
            $table->foreign('customer_id', 'FK_contract_customer_pk')
                ->references('id')->on('customers')
                ->onUpdate('restrict')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
           $table->dropForeign('FK_contract_customer_pk');

            $table->foreign('customer_id', 'FK_contract_customer_pk')
                ->references('id')->on('customers')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }
};
