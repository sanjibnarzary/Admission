<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->string('password', 60);
            $table->unsignedInteger('mobile_code')->nullable();
            $table->unsignedInteger('email_code')->nullable();
            $table->tinyInteger('mobile_active')->default(0);
            $table->tinyInteger('email_active')->default(0);
            //$table->integer('status');//status = 0 just registered, status = 1 email confirmed, status = 2 mobile confirmed, status = 3 both confirmed
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
