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
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'title',
                'value' => config('app.title', 'Ordering Food & Delivery'),
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'phone',
                'value' => '01992 641133',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'mobile',
                'value' => '01992 641133',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'email',
                'value' => 'maithaikitchen@hotmail.com',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'registration_number',
                'value' => '12333551',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'vat_number',
                'value' => '340075044',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'app',
                'type' => 'text',
                'name' => 'referral_bonus',
                'value' => '0',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'delivery_fee',
                'value' => '0',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'processing_fee',
                'value' => '0',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'vat_percent',
                'value' => '0',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'currency_symbol',
                'value' => '£', //'$',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'order',
                'type' => 'text',
                'name' => 'minimum_order',
                'value' => '10',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'opening_time',
                'value' => 'Sunday - Saturday (Everyday)
Lunch Time --------------- 12pm - 3pm
Dinner Time -------------- 5pm - 10pm',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'time',
                'type' => 'textarea',
                'name' => 'delivery_time',
                'value' => 'Everyday --------------- 5pm - 10pm',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'app',
                'type' => 'textarea',
                'name' => 'address',
                'value' => '37 High Street Cheshunt, Waltham Cross EN80BS, UK.',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'logo',
                'value' => 'logo.png',
                'options' => '',
                'require' => 1,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'qrcode',
                'value' => 'qrcode.png',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'rating_image',
                'value' => 'rating_image.png',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'logo',
                'type' => 'file',
                'name' => 'payment_image',
                'value' => 'payment_image.png',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'select',
                'name' => 'send_order_email',
                'value' => 1,
                'options' => json_encode([
                    1 => 'yes',
                    0 => 'no',
                ]),
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'email',
                'name' => 'support_email',
                'value' => 'info@maithaikitchen.co.uk',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_server',
                'value' => 'mail.maithaikitchen.co.uk',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'text',
                'name' => 'email_username',
                'value' => '',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'password',
                'name' => 'email_password',
                'value' => '',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'email',
                'type' => 'password',
                'name' => 'email_server_port',
                'value' => '465',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'payment',
                'type' => 'select',
                'name' => 'enable_payment_method',
                'value' => 1,
                'options' => json_encode([
                    1 => 'yes',
                    0 => 'no',
                ]),
                'require' => 0,
            ],
            [
                'key' => 'payment',
                'type' => 'select',
                'name' => 'payment_mode',
                'value' => 'live',
                'options' => json_encode([
                    'live' => 'live',
                    'sandbox' => 'sandbox',
                ]),
                'require' => 0,
            ],
            [
                'key' => 'payment',
                'type' => 'email',
                'name' => 'paypal_payment_email',
                'value' => 'maithaikitchen@hotmail.com',
                'options' => '',
                'require' => 0,
            ],
            [
                'key' => 'payment',
                'type' => 'email',
                'name' => 'sumup_payment_email',
                'value' => 'maithaikitchen@hotmail.com',
                'options' => '',
                'require' => 0,
            ],
        ]);
    }
}
