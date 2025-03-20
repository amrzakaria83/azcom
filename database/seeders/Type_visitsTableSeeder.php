<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Type_visitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeis = [
            [1, '1', 'A.M.', 0],
            [2, '1', 'P.M.', 0],
        ];

        foreach ($typeis as $type) {
            DB::table('type_visits')->insert([
                'id' => $type[0],
                'emp_id' => $type[1],
                'name_en' => $type[2],
                'status' => $type[3],
            ]);
        }
    }
}