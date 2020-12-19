<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToProductOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_offers', function (Blueprint $table) {
            if (Schema::hasTable('product_offers')) {
                $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::table('product_offers', function (Blueprint $table) {
            if (Schema::hasTable('product_offers')) {
                $table->dropForeign('product_offers_offer_id_foreign');
                $table->dropForeign('product_offers_product_id_foreign');
            }
        });
    }
}
