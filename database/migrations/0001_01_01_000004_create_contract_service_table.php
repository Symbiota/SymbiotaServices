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
        Schema::create('contract_service', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contract_id')->index('fk_contract_pk');
            $table->unsignedInteger('service_id')->index('fk_service_pk');
            $table->text('management_type')->nullable();
            $table->text('portal')->nullable();
            $table->text('globus_folder')->nullable();
            $table->text('collection_profile')->nullable();
            $table->longText('file_path')->nullable();
            $table->string('line_ref_1', 20)->nullable();
            $table->string('line_ref_2', 20)->nullable();
            $table->mediumText('notes')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_service');
    }
};
