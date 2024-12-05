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
        Schema::table('bancard_confirmations', function (Blueprint $table) {
            $table->string('token')->nullable()->after('id');
            $table->decimal('amount')->nullable()->after('token');
            $table->string('currency')->nullable()->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bancard_confirmations', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('amount');
            $table->dropColumn('currency');
        });
    }
};
