<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToSubVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_variants', function (Blueprint $table) {
            if (Schema::hasTable('sub_variants')) {
                $table->foreign('variant_id')->references('id')->on('variants')->onDelete('restrict');
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
        Schema::table('sub_variants', function (Blueprint $table) {
            if (Schema::hasTable('sub_variants')) {
                $table->dropForeign('sub_variants_variant_id_foreign');
            }
        });
    }
}
