<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_details', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->string('full_name', 45);
            $table->string('email', 45)->nullable();
            $table->string('mobile_no', 45)->nullable();
            $table->string('city', 45)->nullable();
            $table->string('state', 45)->nullable();
            $table->string('zip_code', 45)->nullable();
            $table->string('address', 45)->nullable();
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
        Schema::table('shipping_details', function (Blueprint $table) {
            //
        });
    }
}
