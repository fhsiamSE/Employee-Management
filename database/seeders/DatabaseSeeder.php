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
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed roles and admin if spatie/laravel-permission installed
        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'recruiter']);

            $admin = \App\Models\User::firstWhere('email', 'admin@example.com');
            if (! $admin) {
                $admin = \App\Models\User::factory()->create([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('password'),
                ]);
            }

            if (method_exists($admin, 'assignRole')) {
                $admin->assignRole('admin');
            }
        }
    }
}
