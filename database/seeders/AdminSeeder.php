<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks during seeding
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        User::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@spkbansos.id',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Kepala Desa',
            'email'    => 'kades@spkbansos.id',
            'password' => Hash::make('kades123'),
            'role'     => 'viewer',
        ]);
    }
}
