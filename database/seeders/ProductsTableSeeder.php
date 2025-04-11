<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => 1,
                'emp_id' => 1,
                'name_en' => 'prod 1',
                'sell_price' => '1000',
                'description' => '',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:35:34',
                'updated_at' => '2025-03-09 18:35:34',
                'percent' => 0.000
            ],
            [
                'id' => 2,
                'emp_id' => 1,
                'name_en' => 'prod 2',
                'sell_price' => '2000',
                'description' => '',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:35:50',
                'updated_at' => '2025-03-09 18:35:50',
                'percent' => 0.000
            ],
            [
                'id' => 3,
                'emp_id' => 1,
                'name_en' => 'prod 3',
                'sell_price' => '3000',
                'description' => '',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:36:06',
                'updated_at' => '2025-03-09 18:36:06',
                'percent' => 0.000
            ],
            [
                'id' => 4,
                'emp_id' => 1,
                'name_en' => 'prod 4',
                'sell_price' => '4000',
                'description' => '',
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:36:19',
                'updated_at' => '2025-03-09 18:36:19',
                'percent' => 0.000
            ],
        ];

        DB::table('products')->insert($products);
    }
}