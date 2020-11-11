<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->default(0);
            $table->string('invoice_no', 45)->unique();
            $table->string('transaction_no', 45)->nullable()->unique();
            $table->enum('type', ['pos', 'online'])->default('pos');
            $table->enum('payment_type', ['cash', 'card'])->default('cash');
            $table->enum('status', ['completed'])->default('completed');
            $table->enum('payment_status', ['due', 'completed'])->default('completed');
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
        Schema::dropIfExists('sales');
    }
}
