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
        User::factory()->create([
            'id' => 2,
            'nik' => '237210819',
            'name' => 'ANGGI NOPRIALDI',
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

        // Kats
        Kat::factory()->create(['id' => 1, 'name' => 'H2114']);
        Kat::factory()->create(['id' => 2, 'name' => 'H2115']);
        Kat::factory()->create(['id' => 3, 'name' => 'H2116']);

        // Cmo-Kat
        CmoKat::factory()->create(['id' => 1, 'cmo_id' => 2, 'kat_id' => 1]);
        CmoKat::factory()->create(['id' => 2, 'cmo_id' => 2, 'kat_id' => 2]);
    }
}
