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
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->default(0);//->index('fk_contract_customer_pk');
            $table->unsignedInteger('original_contact_id')->nullable();//->default(0)->index('fk_orig_contact_pk');
            $table->string('darbi_header_ref_1', 20)->nullable();
            $table->string('darbi_header_ref_2', 20)->nullable();
            $table->text('darbi_special_instructions')->nullable();
            $table->mediumText('notes')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
