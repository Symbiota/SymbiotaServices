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
        Schema::create('invoice_service', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id')->index('fk_invoice_pk');
            $table->unsignedInteger('service_id')->index('fk_invoice_service_pk');
            $table->string('type', 50)->nullable();
            $table->decimal('qty', 20, 2)->nullable();
            $table->date('date_calculated')->nullable();
            $table->decimal('amount_owed', 20, 2)->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_service');
    }
};
