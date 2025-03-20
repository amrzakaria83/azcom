<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sale_typesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeis = [
            [1, '1', 'Direct', 0, null, null , 0 ],
            
        ];

        foreach ($typeis as $type) {
            DB::table('sale_types')->insert([
                'id' => $type[0],
                'emp_id' => $type[1],
                'name_en' => $type[2],
                'type' => $type[3],
                'note' => $type[4],
                'description' => $type[5],
                'status' => $type[6],
            ]);
        }
    }
}