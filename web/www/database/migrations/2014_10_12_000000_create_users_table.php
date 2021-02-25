<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->integer('role_id')->nullable();
            $table->string('api_token', 120)->nullable()->unique();
            $table->rememberToken();
            $table->string('username', 45)->unique();
            $table->string('password', 120)->index();
            $table->boolean('is_active')->nullable()->default(1);
            $table->string('verify_token', 100)->nullable()->unique();
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
        Schema::dropIfExists('users');
    }
}
