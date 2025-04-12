<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centers = [
            [
                'id' => 1,
                'emp_id' => 1,
                'type_id' => 2,
                'area_id' => 2,
                'name_en' => 'Mohamed Elzonkoly Clinic (Etay)',
                'phone' => '0453331212',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'Elgomhoriaa Street',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 20:39:31',
                'updated_at' => '2025-03-09 20:39:31',
                'lat' => '30.890350387956904',
                'lng' => '30.66338364044597'
            ],
            [
                'id' => 2,
                'emp_id' => 1,
                'type_id' => 1,
                'area_id' => 3,
                'name_en' => 'Shepen university',
                'phone' => '01006512740',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'adress',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 20:48:06',
                'updated_at' => '2025-03-09 20:48:06',
                'lat' => '30.059483014682513',
                'lng' => '31.331921612399615'
            ],
            [
                'id' => 3,
                'emp_id' => 1,
                'type_id' => 2,
                'area_id' => 1,
                'name_en' => 'Tamer Hassan Clinic',
                'phone' => '034819380',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'ميدكال تاور- 8 ش كليه الطب محطه الرمل',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 21:02:03',
                'updated_at' => '2025-03-09 21:02:03',
                'lat' => '31.209160632875374',
                'lng' => '29.910619833603747'
            ],
            [
                'id' => 4,
                'emp_id' => 1,
                'type_id' => 1,
                'area_id' => 6,
                'name_en' => 'center 1',
                'phone' => '00000',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'adress bani',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 21:52:25',
                'updated_at' => '2025-03-09 21:52:25',
                'lat' => '29.073335022349912',
                'lng' => '31.096495464440512'
            ],
            [
                'id' => 5,
                'emp_id' => 1,
                'type_id' => 1,
                'area_id' => 5,
                'name_en' => 'center 2',
                'phone' => '0000',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'Elgomhoriaa Street',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 21:53:17',
                'updated_at' => '2025-03-09 21:53:17',
                'lat' => '30.784184806162777',
                'lng' => '30.996418244384387'
            ],
            [
                'id' => 6,
                'emp_id' => 1,
                'type_id' => 2,
                'area_id' => 7,
                'name_en' => 'center 3',
                'phone' => '01559963440',
                'phone2' => null,
                'landline' => null,
                'landline2' => null,
                'email' => null,
                'website' => null,
                'address' => 'adress',
                'map_location' => null,
                'note' => null,
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-10 21:44:19',
                'updated_at' => '2025-03-10 21:44:19',
                'lat' => '30.462248875026848',
                'lng' => '31.186723073519648'
            ],
        ];

        DB::table('centers')->insert($centers);
    }
}