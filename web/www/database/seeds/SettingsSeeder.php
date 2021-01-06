<?php

use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => config('app.name'),
            'title' => config('app.title', 'Ecommerce & POS'),
            'phone' => '01780292737',
            'mobile' => '01832308565',
            'email' => 'tarekmonjur@gmail.com',
            'registration_number' => '1234567890',
            'vat_number' => '123456',
            'support_email' => 'info@tarekmonjur.com',
            'referral_bonus' => '50',
            'delivery_fee' => '100',
            'processing_fee' => '50',
            'vat_percent' => '2',
            'logo' => '',
            'qrcode' => '',
            'opening_time' => '',
            'delivery_time' => '',
            'address' => '',
        ]);
    }
}
