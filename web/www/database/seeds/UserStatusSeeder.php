<?php

use Illuminate\Database\Seeder;
use App\Models\UserStatus;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table((new UserStatus)->getTable())->insert([
            ['name' => 'Present'],
            ['name' => 'Resign'],
            ['name' => 'fired'],
        ]);
    }
}
