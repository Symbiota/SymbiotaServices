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
        // Remove line_refs from services entirely
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('line_ref_1');
            $table->dropColumn('line_ref_2');
        });

        // Add line_refs to invoice_service table
        Schema::table('invoice_service', function (Blueprint $table) {
            $table->string('line_ref_1', 20)->nullable();
            $table->string('line_ref_2', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('line_ref_1', 20)->nullable();
            $table->string('line_ref_2', 20)->nullable();
        });

        Schema::table('invoice_service', function (Blueprint $table) {
            $table->dropColumn('line_ref_1');
            $table->dropColumn('line_ref_2');
        });
    }
};
