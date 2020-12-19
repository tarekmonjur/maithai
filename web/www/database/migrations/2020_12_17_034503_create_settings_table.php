<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('mobile', 25)->nullable();
            $table->string('email', 45)->nullable();
            $table->string('registration_number', 25)->nullable();
            $table->string('vat_number', 25)->nullable();
            $table->string('support_email',45)->nullable();
            $table->decimal('referral_bonus', 10, 2)->nullable()->default(0);
            $table->decimal('delivery_fee', 10, 2)->nullable()->default(0);
            $table->decimal('processing_fee', 10, 2)->nullable()->default(0);
            $table->string('logo', 100)->nullable();
            $table->string('qrcode', 100)->nullable();
            $table->text('opening_time')->nullable();
            $table->text('delivery_time')->nullable();
            $table->text('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
