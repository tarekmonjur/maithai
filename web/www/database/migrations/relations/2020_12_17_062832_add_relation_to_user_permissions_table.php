<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function (Blueprint $table) {
            if (Schema::hasTable('user_permissions')) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('restrict');
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
        Schema::table('user_permissions', function (Blueprint $table) {
            if (Schema::hasTable('user_permissions')) {
                $table->dropForeign('user_permissions_user_id_foreign');
                $table->dropForeign('user_permissions_customer_id_foreign');
            }
        });
    }
}
