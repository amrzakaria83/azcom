<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Type_centersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeis = [
            [1, '1', 'Hospital', 0],
        ];

        foreach ($typeis as $type) {
            DB::table('type_centers')->insert([
                'id' => $type[0],
                'emp_id' => $type[1],
                'name_en' => $type[2],
                'status' => $type[3],
            ]);
        }
    }
}