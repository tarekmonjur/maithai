<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            if (Schema::hasTable('product_stocks')) {
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('sku_id')->references('id')->on('skus')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_stocks', function (Blueprint $table) {
            if (Schema::hasTable('product_stocks')) {
                $table->dropForeign('product_stocks_product_id_foreign');
                $table->dropForeign('product_stocks_sku_id_foreign');
            }
        });
    }
}
