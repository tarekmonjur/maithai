<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id')->index();
            $table->integer('product_id')->index();
            $table->integer('offer_id')->default(0);
            $table->string('offer_name', 100)->nullable();
            $table->string('product_name', 100);
            $table->string('product_code', 45);
            $table->string('product_barcode', 45);
            $table->string('product_unit')->nullable();
            $table->text('product_variant')->nullable();
            $table->text('product_stock')->nullable();
            $table->decimal('product_price', 8,2)->nullable()->default(0);
            $table->decimal('product_qty', 8,2)->nullable()->default(0);
            $table->decimal('discount_percent', 8,2)->nullable()->default(0);
            $table->decimal('discount_amount', 8,2)->nullable()->default(0);
            $table->decimal('vat_percent', 8,2)->nullable()->default(0);
            $table->decimal('vat_amount', 8,2)->nullable()->default(0);
            $table->decimal('price', 8,2)->nullable()->default(0);
            $table->decimal('sub_total',8,2)->nullable()->default(0);
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
        Schema::dropIfExists('orders_details');
    }
}
