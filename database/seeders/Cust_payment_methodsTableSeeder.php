<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Cust_payment_methodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeis = [
            [1, '1', 'cash', 0],
            
        ];

        foreach ($typeis as $type) {
            DB::table('cust_payment_methods')->insert([
                'id' => $type[0],
                'emp_id' => $type[1],
                'name_en' => $type[2],
                'status' => $type[3],
            ]);
        }
    }
}
