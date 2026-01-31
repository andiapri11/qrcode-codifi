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
        Schema::table('schools', function (Blueprint $table) {
            $table->enum('subscription_type', ['year', 'lifetime'])->default('year')->after('api_key');
            $table->timestamp('subscription_expires_at')->nullable()->after('subscription_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['subscription_type', 'subscription_expires_at']);
        });
    }
};
