<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            if (Schema::hasTable('product_variants')) {
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                $table->foreign('variant_id')->references('id')->on('variants')->onDelete('restrict');
                $table->foreign('sub_variant_id')->references('id')->on('sub_variants')->onDelete('restrict');
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
        Schema::table('product_variants', function (Blueprint $table) {
            if (Schema::hasTable('product_variants')) {
                $table->dropForeign('product_variants_product_id_foreign');
                $table->dropForeign('product_variants_variant_id_foreign');
                $table->dropForeign('product_variants_sub_variant_id_foreign');
            }
        });
    }
}
