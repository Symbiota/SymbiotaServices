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
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('isRecurring')->default(false);
            $table->string('recurringInterval')->nullable();
        });

        Schema::table('services_history', function (Blueprint $table) {
            $table->boolean('isRecurring')->nullable();
            $table->string('recurringInterval')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('isRecurring');
            $table->dropColumn('recurringInterval');
        });

        Schema::table('services_history', function (Blueprint $table) {
            $table->dropColumn('isRecurring');
            $table->dropColumn('recurringInterval');
        });
    }
};
