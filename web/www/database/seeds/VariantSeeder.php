<?php

use Illuminate\Database\Seeder;
use App\Models\Variant;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new Variant)->getTable())->insert([
            ['name' => 'color'],
            ['name' => 'size'],
            ['name' => 'weight'],
        ]);
    }
}
