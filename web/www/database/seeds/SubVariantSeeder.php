<?php

use Illuminate\Database\Seeder;
use App\Models\SubVariant;
use Illuminate\Support\Facades\DB;

class SubVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new SubVariant)->getTable())->insert([
            ['variant_id' => 1, 'name' => 'white'],
            ['variant_id' => 1, 'name' => 'Blue'],
            ['variant_id' => 1, 'name' => 'Red'],

            ['variant_id' => 2, 'name' => 'small'],
            ['variant_id' => 2, 'name' => 'medium'],
            ['variant_id' => 2, 'name' => 'large'],

            ['variant_id' => 3, 'name' => '1kg'],
            ['variant_id' => 3, 'name' => '2kg'],
            ['variant_id' => 3, 'name' => '3kg'],
        ]);
    }
}
