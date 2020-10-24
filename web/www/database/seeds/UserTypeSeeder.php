<?php

use Illuminate\Database\Seeder;
use  App\Models\UserType;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new UserType)->getTable())->insert([
            ['name' => 'Owner'],
            ['name' => 'Founder'],
            ['name' => 'Co-Founder'],
            ['name' => 'Employee'],
            ['name' => 'Employer'],
        ]);
    }
}
