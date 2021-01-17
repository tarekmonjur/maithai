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
        Settings::insert([
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'name',
                'value' => config('app.name'),
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'title',
                'value' => config('app.title', 'Ecommerce & POS'),
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'phone',
                'value' => '01992 641133',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'mobile',
                'value' => '01992 641133',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'email',
                'value' => 'maithaikitchen@hotmail.com',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'registration_number',
                'value' => '12333551',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'vat_number',
                'value' => '340075044',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'referral_bonus',
                'value' => '50',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'delivery_fee',
                'value' => '50',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'processing_fee',
                'value' => '50',
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'vat_percent',
                'value' => '2',
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'opening_time',
                'value' => '',
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'delivery_time',
                'value' => '',
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'address',
                'value' => '',
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'logo',
                'value' => 'logo.png',
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'qrcode',
                'value' => 'qrcode.png',
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'name' => 'support_email',
                'value' => 'info@tarekmonjur.com',
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_server',
                'value' => '',
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_username',
                'value' => '',
            ],
            [
                'key' => 'email',
                'type' => 'password',
                'name' => 'email_password',
                'value' => '',
            ],
        ]);
    }
}
