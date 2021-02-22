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
                'value' => '0',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'delivery_fee',
                'value' => '0',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'processing_fee',
                'value' => '0',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'vat_percent',
                'value' => '0',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'currency_symbol',
                'value' => '£', //'$',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'minimum_order',
                'value' => '10',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'opening_time',
                'value' => 'Sunday - Saturday (Everyday)
Lunch Time --------------- 12pm - 3pm
Dinner Time -------------- 5pm - 10pm',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'delivery_time',
                'value' => 'Everyday --------------- 5pm - 10pm',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'address',
                'value' => '37 High Street Cheshunt, Waltham Cross EN80BS, UK.',
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
                'key' => 'logo',
                'type' => 'file',
                'name' => 'rating_image',
                'value' => 'rating_image.png',
                'require' => 0,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'payment_image',
                'value' => 'payment_image.png',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'name' => 'support_email',
                'value' => 'info@maithaikitchen.co.uk',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_server',
                'value' => 'mail.maithaikitchen.co.uk',
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
            [
                'key' => 'email',
                'type' => 'password',
                'name' => 'email_server_port',
                'value' => '465',
                'require' => 0,
            ],
        ]);
    }
}
