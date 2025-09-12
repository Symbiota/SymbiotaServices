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
            $table->unsignedInteger('current_financial_contact_id');
            $table->unsignedInteger('pi_contact_id')->nullable();
            $table->unsignedInteger('technical_contact_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('current_financial_contact_id');
            $table->dropColumn('pi_contact_id');
            $table->dropColumn('technical_contact_id');
        });
    }
};
