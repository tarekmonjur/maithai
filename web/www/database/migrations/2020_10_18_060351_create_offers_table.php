<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->string('name', 100)->unique();
            $table->string('slug', 160)->unique();
            $table->enum('offer_type', ['product', 'coupon'])->default('product');
            $table->string('coupon_code', 45)->nullable()->unique();
            $table->enum('discount_type', ['percent', 'amount'])->default('percent');
            $table->decimal('discount', 8, 2)->nullable()->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('is_highlight')->nullable()->default(0);
            $table->string('image', 200)->nullable();
            $table->integer('sort')->nullable();
            $table->text('description')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
