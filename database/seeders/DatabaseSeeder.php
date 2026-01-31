<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\ExamLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Super Admin
        User::create([
            'name' => 'Antigravity Admin',
            'email' => 'admin@codifi.id',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        // 2. Create Dummy Schools
        $schools = [
            [
                'name' => 'SMK Codifi Percontohan',
                'slug' => 'smk-codifi',
                'domain_whitelist' => 'scholacbt.id',
            ],
            [
                'name' => 'SMA Negeri 1 Jakarta',
                'slug' => 'sman1-jkt',
                'domain_whitelist' => 'sman1jkt.sch.id',
            ],
            [
                'name' => 'MTs Negeri Kudus',
                'slug' => 'mtsn-kudus',
                'domain_whitelist' => 'mtsnkudus.sch.id',
            ]
        ];

        foreach ($schools as $s) {
            $school = School::create([
                'name' => $s['name'],
                'slug' => $s['slug'],
                'domain_whitelist' => $s['domain_whitelist'],
                'api_key' => Str::random(32),
                'is_active' => true,
            ]);

            // Create an admin for each school
            User::create([
                'name' => 'Admin ' . $s['name'],
                'email' => str_replace('-', '', $s['slug']) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            // Create some dummy links
            ExamLink::create([
                'school_id' => $school->id,
                'title' => 'Ujian Tengah Semester',
                'exam_url' => 'https://' . $s['slug'] . '.scholacbt.id/uts',
                'secure_token' => 'SCHOLA-' . Str::upper(Str::random(12)),
                'is_active' => true,
            ]);
        }
    }
}
