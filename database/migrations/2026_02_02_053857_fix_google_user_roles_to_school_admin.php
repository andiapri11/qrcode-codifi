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
        // Fix users who registered via Google and got 'admin' role instead of 'school_admin'
        \App\Models\User::where('role', 'admin')->update(['role' => 'school_admin']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert 'school_admin' back to 'admin'? Ideally not needed as 'admin' was a bug.
        // But for strict rollback:
        // \App\Models\User::where('role', 'school_admin')->update(['role' => 'admin']); 
        // We leave it empty as 'school_admin' is the correct state.
    }
};
