<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'BH'],
            ['id' => 2, 'name' => 'CMO'],
        ]);

        // Users
        DB::table('users')->insert([
            ['id' => 1, 'nik' => '237215704', 'name' => 'MUS ANGGA SAPUTRA', 'password' => Hash::make('password'), 'role_id' => 1],
            ['id' => 2, 'nik' => '237210819', 'name' => 'ANGGI NOPRIALDI', 'password' => Hash::make('password'), 'role_id' => 2],
        ]);

        // Regions
        DB::table('regions')->insert([
            ['id' => 1, 'name' => 'JABODETABEK'],
            ['id' => 2, 'name' => 'JATIM BALI']
        ]);

        // Branches
        DB::table('branches')->insert([
            ['id' => 1, 'name' => 'JAKARTA TIMUR', 'region_id' => 1],
            ['id' => 2, 'name' => 'JAKARTA SELATAN', 'region_id' => 1],
            ['id' => 3, 'name' => 'MALANG', 'region_id' => 2],
        ]);

        // User-Branch
        DB::table('user_branches')->insert([
            ['id' => 1, 'user_id' => 1, 'branch_id' => 1], // Branch Head in Branch A
            ['id' => 2, 'user_id' => 2, 'branch_id' => 1], // CMO in Branch A
        ]);

        // Kats
        DB::table('kats')->insert([
            ['id' => 1, 'name' => 'H2114'],
            ['id' => 2, 'name' => 'H2115'],
            ['id' => 3, 'name' => 'H2116'],
        ]);

        // Region-Branch
        DB::table('cmo_kats')->insert([
            ['id' => 1, 'cmo_id' => 2, 'kat_id' => 1],
            ['id' => 2, 'cmo_id' => 2, 'kat_id' => 2],
        ]);
    }
}
