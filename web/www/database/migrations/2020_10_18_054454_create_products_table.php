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
            $table->integer('id', 'true');
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->index();
            $table->integer('sub_category_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->string('name', 100)->index()->unique();
            $table->string('code', 45)->index()->unique();
            $table->string('barcode', 45)->index()->unique();
            $table->string('slug', 160)->index()->unique();
            $table->string('image', 200)->nullable();
            $table->integer('sort')->nullable();
            $table->decimal('original_price', 8, 2)->nullable()->default(0);
            $table->decimal('regular_price', 8, 2)->nullable()->default(0);
            $table->decimal('special_price', 8, 2)->nullable()->default(0);
            $table->decimal('vat_percent', 5, 2)->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0)->comment('total stock');
            $table->boolean('is_stock')->nullable()->default(0)->comment('for ui');
            $table->boolean('is_new')->nullable()->default(0);
            $table->boolean('is_package')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(0);
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
        Schema::dropIfExists('products');
    }
}
