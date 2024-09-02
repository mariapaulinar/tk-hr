<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsReportConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $country = \App\Models\Country::where('code', 'ES')->first();
        if (!$country) {
            $country = \App\Models\Country::create([
                'name' => 'Spain',
                'code' => 'es',
            ]);
        }
        if ($country) {
            DB::table('costs_reports_config')->insert([
                'country_id' => $country->id,
                'concept_1_title' => 'Bruto',
                'concept_2_title' => 'Variables',
                'concept_3_title' => 'Neto',
                'concept_4_title' => 'SS Emp.',
                'concept_5_title' => 'IRPF',
                'concept_6_title' => 'SS Trab.',
                'concept_7_title' => 'Coste Total',
            ]);
        }
    }
}
