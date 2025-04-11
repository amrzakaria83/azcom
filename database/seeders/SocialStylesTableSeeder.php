<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialStylesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $styles = [
            [
                'id' => 1,
                'emp_id' => 1,
                'name_en' => 'Expressive',
                'description' => '<ul style="box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #181c32; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;">
                <li style="box-sizing: border-box;">Key traits: Enthusiastic, persuasive, creative, spontaneous.</li>
                <li style="box-sizing: border-box;">Focus: Vision and excitement.</li>
                </ul>',
                'note' => '(Yellow)',
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:45:54',
                'updated_at' => '2025-03-09 18:45:54'
            ],
            [
                'id' => 2,
                'emp_id' => 1,
                'name_en' => 'Amiable',
                'description' => '<ul style="box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #7e8299; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;">
                <li style="box-sizing: border-box;">Key traits: Supportive, empathetic, cooperative, loyal.</li>
                <li style="box-sizing: border-box;">Focus: Relationships and harmony.</li>
                </ul>',
                'note' => '(Green)',
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 18:46:29',
                'updated_at' => '2025-03-09 18:46:29'
            ],
            [
                'id' => 3,
                'emp_id' => 1,
                'name_en' => 'Driver',
                'description' => '<ul style="box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-hover-color) transparent; color: #181c32; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;">
                <li style="box-sizing: border-box;">Key traits: Results-driven, decisive, independent, assertive.</li>
                <li style="box-sizing: border-box;">Focus: Efficiency and outcomes.</li>
                </ul>',
                'note' => '(Red)',
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 21:45:24',
                'updated_at' => '2025-03-09 21:45:24'
            ],
            [
                'id' => 4,
                'emp_id' => 1,
                'name_en' => 'Analytical',
                'description' => '<ul style="box-sizing: border-box; padding-left: 2rem; margin-top: 0px; margin-bottom: 1rem; scrollbar-width: thin; scrollbar-color: var(--bs-scrollbar-color) transparent; color: #7e8299; font-family: Inter, Helvetica, \'sans-serif\'; font-size: 13.975px; font-weight: 600; text-transform: capitalize; background-color: #ffffff;">
                <li style="box-sizing: border-box;">Key traits: Logical, detail-oriented, cautious, structured.</li>
                <li style="box-sizing: border-box;">Focus: Facts and accuracy.</li>
                </ul>',
                'note' => '(Blue)',
                'status' => 0,
                'deleted_at' => null,
                'created_at' => '2025-03-09 21:45:52',
                'updated_at' => '2025-03-09 21:45:52'
            ],
        ];

        DB::table('social_styls')->insert($styles);
    }
}