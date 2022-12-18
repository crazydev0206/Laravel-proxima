<?php

use Illuminate\Support\Facades\Schema;
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
            
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type')->nullable();
            $table->string('step')->nullable();
            
            // user personal information
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('avatar')->nullable();
            $table->string('image')->nullable();
            $table->string('country')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();

            // account status
            $table->tinyInteger('delete')->nullable();
            $table->tinyInteger('suspend')->nullable();
            $table->tinyInteger('status')->nullable();

            // database usage
            $table->string('lang')->nullable();
            $table->rememberToken();
            $table->timestamp('created_on');
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
        Schema::dropIfExists('users');
    }
}
