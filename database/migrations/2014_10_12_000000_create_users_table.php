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
            $table->increments('id');

            $table->string('avatar')->default('');
            $table->string('nick_name', 24);
            $table->string('email', 30)->unique();
            $table->string('password');

            $table->integer('credit1')->default(0);
            $table->integer('credit2')->default(0);
            $table->integer('credit3')->default(0);

            $table->tinyInteger('is_active')->comment('1:active,-1:unactive');
            $table->tinyInteger('is_lock')->default(-1)->comment('1:lock,-1:unlock');

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
        Schema::dropIfExists('users');
    }
}
