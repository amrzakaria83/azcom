<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Setting;
use App\Models\Employee;
use App\Models\Page;
use App\Models\Info;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Setting::factory(1)->create();
        // Employee::factory(3)->create();
        // Page::factory(1)->create();
        $this->call([
            
            PermissionSeeder::class,
            EmployeeSeeder::class,
            AccountTreeSeeder::class,
            CitiesTableSeeder::class,
            CountriesTableSeeder::class,
            EmiratesTableSeeder::class,
            GovernoratesTableSeeder::class,
            Type_visitsTableSeeder::class,
            Sale_typesTableSeeder::class,
            // ModelHasRolesTableSeeder::class,

        ]);
    }
}
