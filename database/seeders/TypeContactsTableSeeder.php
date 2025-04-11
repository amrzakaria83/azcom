<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeContacts = [
            [
                'id' => 1,
                'emp_id' => 1,
                'name_en' => 'friendly',
                'favcolor' => '#2c70dd',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:37:30',
                'updated_at' => '2025-03-09 18:37:30'
            ],
            [
                'id' => 2,
                'emp_id' => 1,
                'name_en' => 'aggressive',
                'favcolor' => '#e12d2d',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:39:32',
                'updated_at' => '2025-03-09 18:39:32'
            ],
            [
                'id' => 3,
                'emp_id' => 1,
                'name_en' => 'Ethical',
                'favcolor' => '#069809',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-10 21:31:34',
                'updated_at' => '2025-03-10 21:31:34'
            ],
        ];

        DB::table('type_contacts')->insert($typeContacts);
    }
}