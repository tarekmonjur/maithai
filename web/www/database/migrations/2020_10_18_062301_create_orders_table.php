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
            $table->integer('id', 'true');
            $table->integer('customer_id')->index()->default(-1);
            $table->string('invoice_no', 45)->unique();
            $table->string('transaction_no', 45)->nullable()->unique();
            $table->integer('table_id')->nullable();
            $table->string('table_no', 45)->nullable()->default(0);
            $table->integer('offer_id')->nullable();
            $table->string('offer_name', 100)->nullable();
            $table->string('coupon_code', 45)->nullable();
            $table->enum('type', ['sales', 'purchase'])->default('sales');
            $table->enum('source', ['pos', 'online', 'table'])->default('pos');
            $table->enum('payment_type', ['none' ,'cash', 'card'])->default('none');
            $table->enum('payment_status', ['pending', 'due', 'completed'])->default('pending');
            $table->enum('status', ['placed','pending', 'accepted', 'delivered', 'completed', 'cancel'])->default('placed');
            $table->decimal('total_qty', 8, 2)->nullable()->default(0);
            $table->decimal('total_sub_total_amount', 8,2)->nullable()->default(0);
            $table->decimal('total_sub_discount_percent', 8,2)->nullable()->default(0);
            $table->decimal('total_sub_discount_amount',8,2)->nullable()->default(0);
            $table->decimal('total_sub_vat_percent', 8,2)->nullable()->default(0);
            $table->decimal('total_sub_vat_amount', 8,2)->nullable()->default(0);
            $table->decimal('discount_percent', 8,2)->nullable()->default(0);
            $table->decimal('discount_amount', 8,2)->nullable()->default(0);
            $table->decimal('vat_percent', 8,2)->nullable()->default(0);
            $table->decimal('vat_amount', 8,2)->nullable()->default(0);
            $table->decimal('delivery_fee', 8,2)->nullable()->default(0);
            $table->decimal('processing_fee', 8,2)->nullable()->default(0);
            $table->decimal('total_payable_amount', 8,2)->nullable()->default(0);
            $table->decimal('due_amount', 8,2)->nullable()->default(0);
            $table->decimal('total_pay_amount', 8,2)->nullable()->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
