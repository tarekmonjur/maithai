<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->integer('order_id')->index();
            $table->string('full_name', 45);
            $table->string('email', 45)->nullable();
            $table->string('mobile_no', 25);
            $table->string('city', 25)->nullable();
            $table->string('state', 25)->nullable();
            $table->string('zip_code', 25)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_details');
    }
}
