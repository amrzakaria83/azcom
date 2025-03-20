<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employee = Employee::create([
            'name_en' => 'Super Admin',
            'name_ar' => 'رئيسي',
            'phone' => '***********',
            'email' => 'admin1@az.com',
            'password' => Hash::make('123456789'),
            'is_active' => '1',
            'role_id' => 1,
            'national_id' => '************', // Generate a unique 12-digit number
            'birth_date' => '2002-11-18',
            'work_date' => '2002-11-18',
            'address1' => 'address',
            'gender' => 1,
            'type' => 0,
        ]);
        $employee->assignRole('super admin');
    }
}
