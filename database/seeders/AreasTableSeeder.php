<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['id' => 1,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'abu quir 1','egy_or_uea_id' => '93','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 18:27:32','updated_at' => '2025-03-09 18:27:32'],
            ['id' => 2,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'damanhour  1','egy_or_uea_id' => '164','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 18:27:51','updated_at' => '2025-03-09 18:27:51'],
            ['id' => 3,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'nasr city 1','egy_or_uea_id' => '39','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 18:28:45','updated_at' => '2025-03-09 18:28:45'],
            ['id' => 4,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'az1','egy_or_uea_id' => '95','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 21:49:20','updated_at' => '2025-03-09 21:49:20'],
            ['id' => 5,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'tanta1','egy_or_uea_id' => '192','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 21:49:37','updated_at' => '2025-03-09 21:49:37'],
            ['id' => 6,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'banisweif 1','egy_or_uea_id' => '277','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 21:50:20','updated_at' => '2025-03-09 21:50:20'],
            ['id' => 7,'emp_id' => 1,'country_id' => 'EGY','name_en' => 'banha1','egy_or_uea_id' => '231','note' => null,'status' => 0,'deleted_at' => null,'created_at' => '2025-03-09 21:50:46','updated_at' => '2025-03-09 21:50:46'],
        ];

        DB::table('areas')->insert($areas);
    }
}