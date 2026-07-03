<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Nullable, da es nur eine *alternative* Adresse ist (nicht immer ausgefüllt)
            $table->string('delivery_street')->nullable()->after('status');
            $table->string('delivery_zip')->nullable()->after('delivery_street');
            $table->string('delivery_city')->nullable()->after('delivery_zip');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_street', 'delivery_zip', 'delivery_city']);
        });
    }
};