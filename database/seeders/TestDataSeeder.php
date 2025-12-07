<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Application;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user for login
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create test employees
        Employee::firstOrCreate(
            ['email' => 'john@company.com'],
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'phone' => '01234567890',
                'position' => 'Software Engineer',
                'department' => 'IT',
                'hired_at' => now()->subMonths(6),
            ]
        );

        Employee::firstOrCreate(
            ['email' => 'jane@company.com'],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'phone' => '01987654321',
                'position' => 'HR Manager',
                'department' => 'Human Resources',
                'hired_at' => now()->subMonths(12),
            ]
        );

        // Create a test application (simulating one from the form)
        Application::firstOrCreate(
            ['email' => 'fh@gmail.com'],
            [
                'name' => 'FH Applicant',
                'phone' => '01998890092',
                'cv_path' => 'cvs/test.pdf',
                'status' => 'pending',
            ]
        );

        $this->command->info('Test data seeded successfully!');
    }
}
