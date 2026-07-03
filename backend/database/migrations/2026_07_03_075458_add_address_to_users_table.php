<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Neue Spalten nach dem Passwort einfügen
            $table->string('delivery_street')->nullable()->after('password');
            $table->string('delivery_zip')->nullable()->after('delivery_street');
            $table->string('delivery_city')->nullable()->after('delivery_zip');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['delivery_street', 'delivery_zip', 'delivery_city']);
        });
    }
};
