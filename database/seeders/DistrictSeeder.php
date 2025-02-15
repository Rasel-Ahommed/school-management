<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/bd-districts.json'));
        $districts = json_decode($json, true)['districts'];

        foreach ($districts as $district) {
            DB::table('districts')->insert([
                'id' => $district['id'],
                'name' => $district['name'],
                'bn_name' => $district['bn_name'],
                'lat' => $district['lat'],
                'long' => $district['long'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
