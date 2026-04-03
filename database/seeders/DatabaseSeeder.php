<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        $adminRole = \App\Models\Role::create(['nama_role' => 'admin']);
        \App\Models\Role::create(['nama_role' => 'petugas']);
        \App\Models\Role::create(['nama_role' => 'masyarakat']);

        \App\Models\User::create([
            'nama_lengkap' => 'Administrator System',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'telp' => '08123456789',
            'role_id' => $adminRole->id,
        ]);
    }
}
