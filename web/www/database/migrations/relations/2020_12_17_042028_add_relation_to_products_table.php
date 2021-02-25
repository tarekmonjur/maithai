<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasTable('products')) {
                $table->foreign('brand_id')->references('id')->on('brands')->onDelete('restrict');
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
                $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('restrict');
                $table->foreign('unit_id')->references('id')->on('units')->onDelete('restrict');
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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasTable('products')) {
                $table->dropForeign('products_brand_id_foreign');
                $table->dropForeign('products_category_id_foreign');
                $table->dropForeign('products_sub_category_id_foreign');
                $table->dropForeign('products_unit_id_foreign');
            }
        });
    }
}
