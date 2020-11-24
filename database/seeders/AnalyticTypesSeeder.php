<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnalyticTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('analytic_types')->insert([
            [
                'name' => 'max_Bld_Height_m',
                'units' => 'm',
                'is_numeric' => true,
                'num_decimal_places' => 1,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'min_lot_size_m2',
                'units' => 'm2',
                'is_numeric' => true,
                'num_decimal_places' => 0,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'fsr',
                'units' => '1',
                'is_numeric' => true,
                'num_decimal_places' => 2,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
