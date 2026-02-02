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
        Schema::table('schools', function (Blueprint $blueprint) {
            $blueprint->string('school_code', 5)->nullable()->unique()->after('slug');
        });

        // Generate codes for existing schools
        $schools = \App\Models\School::all();
        foreach ($schools as $school) {
            if (!$school->school_code) {
                do {
                    $code = strtoupper(\Illuminate\Support\Str::random(5));
                } while (\App\Models\School::where('school_code', $code)->exists());
                
                $school->update(['school_code' => $code]);
            }
        }
        
        Schema::table('schools', function (Blueprint $blueprint) {
            $blueprint->string('school_code', 5)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $blueprint) {
            $blueprint->dropColumn('school_code');
        });
    }
};
