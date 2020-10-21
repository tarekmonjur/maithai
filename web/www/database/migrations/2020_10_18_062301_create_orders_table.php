<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->string('invoice_no', 45);
            $table->string('transaction_no', 45);
            $table->enum('payment_type', ['cash', 'card'])->default('cash');
            $table->enum('payment_status', ['pending', 'due', 'completed'])->default('pending');
            $table->enum('status', ['pending', 'accepted', 'delivered', 'completed', 'cancel'])->default('pending');
            $table->decimal('total_qty', 8, 2);
            $table->decimal('total_sub_total_amount', 8,2);
            $table->decimal('total_sub_discount_percent', 8,2);
            $table->decimal('total_sub_discount_amount',8,2);
            $table->decimal('total_sub_vat_percent', 8,2);
            $table->decimal('total_sub_vat_amount', 8,2);
            $table->decimal('discount_percent', 8,2);
            $table->decimal('discount_amount', 8,2);
            $table->decimal('vat_percent', 8,2);
            $table->decimal('vat_amount', 8,2);
            $table->decimal('delivery_fee', 8,2);
            $table->decimal('processing_fee', 8,2);
            $table->decimal('total_payable_amount', 8,2);
            $table->decimal('due_amount', 8,2);
            $table->decimal('total_pay_amount', 8,2);
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
        Schema::dropIfExists('orders');
    }
}
