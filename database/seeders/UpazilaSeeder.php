<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = file_get_contents(database_path('seeders/bd-upazilas.json'));
        $upazilas = json_decode($json, true)['upazilas'];

        foreach ($upazilas as $upazila) {
            DB::table('upazilas')->insert([
                'id' => $upazila['id'],
                'district_id' => $upazila['district_id'],
                'name' => $upazila['name'],
                'bn_name' => $upazila['bn_name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
