<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id')->default(0);
            $table->integer('type_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->integer('sub_category_id')->default(0);
            $table->integer('unit_id')->default(0);
            $table->string('name', 100)->index()->unique();
            $table->string('code', 45)->index()->unique();
            $table->string('slug', 160)->index()->unique();
            $table->decimal('regular_price', 8, 2)->default(0);
            $table->decimal('special_price', 8, 2)->default(0);
            $table->decimal('vat_percent', 5, 2)->default(0);
            $table->boolean('is_stock')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('products');
    }
}
