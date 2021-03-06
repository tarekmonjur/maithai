<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->integer('id', 'true');
            $table->integer('user_id');
            $table->integer('user_type_id')->nullable();
            $table->integer('user_service_type_id')->nullable();
            $table->integer('user_status_id')->nullable();
            $table->string('first_name', 45)->index();
            $table->string('last_name', 45)->nullable();
            $table->string('email', 45)->nullable()->unique();
            $table->string('mobile_no', 25)->nullable()->unique();
            $table->string('designation', 100)->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('other');
            $table->date('date_of_birth')->nullable();
            $table->date('joining_date')->nullable();
            $table->string('photo', 100)->nullable();
            $table->string('f_name', 45)->nullable();
            $table->string('m_name', 45)->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->decimal('salary', 8, 2)->nullable()->default(0);
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
        Schema::dropIfExists('user_details');
    }
}
