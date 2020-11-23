<?php

use Illuminate\Database\Seeder;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Unit)->getTable())->insert([
            [
                'name' => 'kg',
                'is_active' => 1,
            ],
            [
                'name' => 'box',
                'is_active' => 1,
            ],
            [
                'name' => 'single',
                'is_active' => 1,
            ]
        ]);
    }
}
