<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToRolePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permissions', function (Blueprint $table) {
            if (Schema::hasTable('role_permissions')) {
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
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
        Schema::table('role_permissions', function (Blueprint $table) {
            if (Schema::hasTable('role_permissions')) {
                $table->dropForeign('role_permissions_role_id_foreign');
                $table->dropForeign('role_permissions_menu_id_foreign');
            }
        });
    }
}
