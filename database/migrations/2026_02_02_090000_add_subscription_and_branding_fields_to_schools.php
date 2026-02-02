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
            $table->integer('max_links')->default(20)->after('subscription_expires_at');
            $table->string('theme_color')->default('#3C50E0')->after('max_links');
            $table->string('supervisor_password')->nullable()->after('theme_color');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained()->onDelete('cascade');
            $table->string('reference')->unique();
            $table->string('type'); // 6_months, 1_year, lifetime
            $table->decimal('amount', 15, 2);
            $table->string('status')->default('pending'); // pending, success, failed, expired
            $table->string('snap_token')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('midtrans_payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['max_links', 'theme_color', 'supervisor_password']);
        });
    }
};
