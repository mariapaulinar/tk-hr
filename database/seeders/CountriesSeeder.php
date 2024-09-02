<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(resource_path('js/countries.json'));
        $countries = json_decode($json, true);

        \App\Models\Country::query()->delete();

        foreach ($countries as $key => $country) {
            \App\Models\Country::create([
                'name' => $country,
                'code' => $key,
            ]);
        }
    }
}
