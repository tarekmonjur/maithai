<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Customer;
use App\Models\CustomerDetails;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         $this->call(UsersTableSeeder::class);

//         factory(App\Models\User::class, 2)->create();
//         factory(App\Models\UserDetails::class, 2)->create();

        $this->call(UserTypeSeeder::class);
        $this->call(UserStatusSeeder::class);
        $this->call(UserServiceTypeSeeder::class);

        factory(User::class, 13)
            ->create()
            ->each(function ($user) {
                factory(UserDetails::class)->create(['user_id' => $user->id]);
            });

        factory(Customer::class, 13)
            ->create()
            ->each(function ($customer) {
                factory(CustomerDetails::class)->create(['customer_id' => $customer->id]);
            });

        $this->call(VariantSeeder::class);
        $this->call(VariantTypeSeeder::class);



    }
}
