<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            [
                'id' => 1,
                'emp_id' => 1,
                'name_en' => 'Dermatology',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:30:08',
                'updated_at' => '2025-03-09 18:30:08'
            ],
            [
                'id' => 2,
                'emp_id' => 1,
                'name_en' => 'Neurology',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:30:56',
                'updated_at' => '2025-03-09 18:30:56'
            ],
            [
                'id' => 3,
                'emp_id' => 1,
                'name_en' => 'Obstetrics and Gynecology',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:31:11',
                'updated_at' => '2025-03-09 18:31:11'
            ],
            [
                'id' => 4,
                'emp_id' => 1,
                'name_en' => 'Pediatrics',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:31:34',
                'updated_at' => '2025-03-09 18:31:34'
            ],
            [
                'id' => 5,
                'emp_id' => 1,
                'name_en' => 'Psychiatry',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:32:05',
                'updated_at' => '2025-03-09 18:32:05'
            ],
            [
                'id' => 6,
                'emp_id' => 1,
                'name_en' => 'Rheumatology',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:32:26',
                'updated_at' => '2025-03-09 18:32:26'
            ],
            [
                'id' => 7,
                'emp_id' => 1,
                'name_en' => 'dermatologic oncology',
                'parent_id' => '1',
                'type_specialty' => 1,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:33:22',
                'updated_at' => '2025-03-09 18:33:22'
            ],
            [
                'id' => 8,
                'emp_id' => 1,
                'name_en' => 'pediatric cardiology',
                'parent_id' => '4',
                'type_specialty' => 1,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:34:17',
                'updated_at' => '2025-03-09 18:34:17'
            ],
            [
                'id' => 9,
                'emp_id' => 1,
                'name_en' => 'General Surgery',
                'parent_id' => null,
                'type_specialty' => 0,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:34:47',
                'updated_at' => '2025-03-09 18:34:47'
            ],
        ];

        DB::table('specialties')->insert($specialties);
    }
}