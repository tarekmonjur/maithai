<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sale_id');
            $table->integer('product_id');
            $table->integer('offer_id')->default(0);
            $table->string('offer_name', 100)->nullable();
            $table->string('product_name', 100);
            $table->string('product_code', 45);
            $table->string('product_variant')->nullable();
            $table->string('product_unit')->nullable();
            $table->decimal('product_price', 8,2);
            $table->decimal('product_qty', 8,2);
            $table->decimal('product_sub_total',8,2);
            $table->decimal('discount_percent', 8,2);
            $table->decimal('discount_amount', 8,2);
            $table->decimal('vat_percent', 8,2);
            $table->decimal('vat_amount', 8,2);
            $table->decimal('total_price', 8,2);
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
        Schema::dropIfExists('sale_details');
    }
}
