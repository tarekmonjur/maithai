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
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'title',
                'value' => config('app.title', 'Ecommerce & POS'),
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'phone',
                'value' => '01992 641133',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'mobile',
                'value' => '01992 641133',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'email',
                'value' => 'maithaikitchen@hotmail.com',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'registration_number',
                'value' => '12333551',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'vat_number',
                'value' => '340075044',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'referral_bonus',
                'value' => '50',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'delivery_fee',
                'value' => '50',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'processing_fee',
                'value' => '50',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'vat_percent',
                'value' => '2',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'currency_symbol',
                'value' => '$',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'opening_time',
                'value' => '',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'delivery_time',
                'value' => '',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'address',
                'value' => '',
                'require' => 0,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'logo',
                'value' => 'logo.png',
                'require' => 1,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'qrcode',
                'value' => 'qrcode.png',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'name' => 'support_email',
                'value' => 'info@tarekmonjur.com',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_server',
                'value' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_username',
                'value' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'password',
                'name' => 'email_password',
                'value' => '',
                'require' => 0,
            ],
        ]);
    }
}
