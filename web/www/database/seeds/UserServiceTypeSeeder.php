<?php

use Illuminate\Database\Seeder;
use App\Models\UserServiceType;
use Illuminate\Support\Facades\DB;

class UserServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new UserServiceType)->getTable())->insert([
            ['name' => 'Permanent'],
            ['name' => 'Part-Time'],
            ['name' => 'Probation Period'],
            ['name' => 'Contractual'],
            ['name' => 'Hourly'],
            ['name' => 'Daily'],
        ]);
    }
}
