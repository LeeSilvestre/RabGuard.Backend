<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\User::create([
        //     'name' => 'Juan Dela Cruz',
        //     'email' => 'delacruz@sna.edu.ph',
        //     'password' => Hash::make('SNA2024@delacruz'),
        //     'role' => 'admin',
        //     'department' => 'admin'

        // ]);
        // \App\Models\User::create([
        //     'name' => 'Albert Cruz',
        //     'email' => 'cruz@sna.edu.ph',
        //     'password' => Hash::make('SNA2024@delacruz'),
        //     'role' => 'encoder',
        //     'department' => 'registrar'

        // ]);
        // \App\Models\User::create([
        //     'name' => 'Weng Cheng Garcia',
        //     'email' => 'garcia@sna.edu.ph',
        //     'password' => Hash::make('SNA2024@garcia'),
        //     'role' => 'assessor',
        //     'department' => 'registrar'

        // ]);
        // \App\Models\User::create([
        //     'name' => 'guidance',
        //     'email' => 'guidance@sna.edu.ph',
        //     'password' => Hash::make('password123'),
        //     'role' => 'admin',
        //     'department' => 'guidance'

        // ]);
        // \App\Models\User::create([
        //     'name' => 'disciplinary',
        //     'email' => 'disciplinary@sna.edu.ph',
        //     'password' => Hash::make('password123'),
        //     'role' => 'user',
        //     'department' => 'guidance'

        // ]);
        // \App\Models\User::create([
        //     'name' => 'Patrick Noel Pacis',
        //     'email' => 'pacis@sna.edu.ph',
        //     'password' => Hash::make('pacis@2024'),
        //     'role' => 'admin',
        //     'department' => 'inventory'

        // ]);
        \App\Models\User::create([
            'name' => 'Patrick Noel Pacis',
            'email' => 'clinic@sna.edu.ph',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'department' => 'clinic'

        ]);
    }
}
