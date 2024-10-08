<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\CmoKat;
use App\Models\Kat;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use App\Models\UserBranch;
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
        // Roles
        Role::create(['id' => 1, 'name' => 'BH']);
        Role::create(['id' => 2, 'name' => 'CMO']);

        // Users
        User::factory()->create([
            'id' => 1,
            'nik' => '237215704',
            'name' => 'MUS ANGGA SAPUTRA',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // User CMO
        User::factory()->create([
            'id' => 2,
            'nik' => '237210819',
            'name' => 'ANGGI NOPRIALDI',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        User::factory()->create([
            'id' => 3,
            'nik' => '237212811',
            'name' => 'REDIKSON FIDELIUS NADEAK',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        // Regions
        Region::factory()->create(['id' => 1, 'name' => 'JABODETABEK']);
        Region::factory()->create(['id' => 2, 'name' => 'JATIM BALI']);

        // Branches
        Branch::factory()->create(['id' => 1, 'name' => 'JAKARTA TIMUR', 'region_id' => 1]);
        Branch::factory()->create(['id' => 2, 'name' => 'JAKARTA SELATAN', 'region_id' => 1]);
        Branch::factory()->create(['id' => 3, 'name' => 'MALANG', 'region_id' => 2]);

        // User-Branch
        UserBranch::factory()->create(['id' => 1, 'user_id' => 1, 'branch_id' => 1]); // Branch Head in Branch A
        UserBranch::factory()->create(['id' => 2, 'user_id' => 2, 'branch_id' => 1]); // CMO in Branch A
        UserBranch::factory()->create(['id' => 3, 'user_id' => 3, 'branch_id' => 1]); // CMO in Branch A

        // Kats
        Kat::factory()->create(['id' => 1, 'name' => 'H2114']);
        Kat::factory()->create(['id' => 2, 'name' => 'H2115']);
        Kat::factory()->create(['id' => 3, 'name' => 'H2116']);
        Kat::factory()->create(['id' => 4, 'name' => 'H2117']);
        Kat::factory()->create(['id' => 5, 'name' => 'H2118']);
        Kat::factory()->create(['id' => 6, 'name' => 'H2119']);
        Kat::factory()->create(['id' => 7, 'name' => 'H2120']);
        Kat::factory()->create(['id' => 8, 'name' => 'H2121']);
        Kat::factory()->create(['id' => 9, 'name' => 'H2122']);
        Kat::factory()->create(['id' => 10, 'name' => 'H2123']);
        Kat::factory()->create(['id' => 11, 'name' => 'H2124']);
        Kat::factory()->create(['id' => 12, 'name' => 'H2125']);
        Kat::factory()->create(['id' => 13, 'name' => 'H2126']);
        Kat::factory()->create(['id' => 14, 'name' => 'H2127']);
        Kat::factory()->create(['id' => 15, 'name' => 'H2128']);
        Kat::factory()->create(['id' => 16, 'name' => 'H2129']);
        Kat::factory()->create(['id' => 17, 'name' => 'H2130']);

        // Cmo-Kat
        CmoKat::factory()->create(['id' => 1, 'cmo_id' => 2, 'kat_id' => 1]);
        CmoKat::factory()->create(['id' => 2, 'cmo_id' => 2, 'kat_id' => 2]);
    }
}
