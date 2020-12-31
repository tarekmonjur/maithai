<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\UserDetails;
use App\Models\Customer;
use App\Models\CustomerDetails;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductStock;
use App\Models\Sku;

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

        // system user
        factory(User::class, 1)
            ->create(['id' => -1, 'username' => 'admin'])
            ->each(function ($user) {
                factory(UserDetails::class)->create(['user_id' => $user->id]);
            });

        factory(User::class, 13)
            ->create()
            ->each(function ($user) {
                factory(UserDetails::class)->create(['user_id' => $user->id]);
            });

        // system customer
        factory(Customer::class, 1)
            ->create(['id' => -1, 'username' => 'admin'])
            ->each(function ($customer) {
                factory(CustomerDetails::class)->create(['customer_id' => $customer->id]);
            });

        factory(Customer::class, 13)
            ->create()
            ->each(function ($customer) {
                factory(CustomerDetails::class)->create(['customer_id' => $customer->id]);
            });

        $this->call(UnitSeeder::class);
        $this->call(VariantSeeder::class);
        $this->call(SubVariantSeeder::class);

        factory(Category::class, 10)
            ->create()
            ->each(function ($category) {
                factory(SubCategory::class, 5)->create(['category_id' => $category->id]);
            });

        factory(Sku::class, 25)->create();

        factory(Product::class, 50)
            ->create()
            ->each(function ($product){
                $qty = rand(1,9);
                factory(ProductVariant::class, 3)->create(['product_id' => $product->id]);
                factory(ProductStock::class, 3)->create(['product_id' => $product->id, 'stock' => $qty * 3]);
            });

    }
}
