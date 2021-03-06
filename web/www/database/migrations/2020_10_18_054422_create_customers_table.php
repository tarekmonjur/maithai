<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->string('oauth_id', 45)->nullable();
            $table->string('access_token', 120)->index()->nullable();
            $table->string('username', 45)->unique();
            $table->string('password', 120)->index();
            $table->rememberToken();
            $table->string('referral_code', 45)->unique();
            $table->integer('referrer_id')->nullable();
            $table->boolean('is_membership')->nullable()->default(0);
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('email_verified')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
