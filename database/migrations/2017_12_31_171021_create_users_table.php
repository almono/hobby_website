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
        Schema::create('Users', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('username', 32);
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('email', 64);
            $table->string('password', 64);
            $table->enum('is_admin', array('0', '1'));
            $table->string('remember_token', 100)->nullable();
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
        Schema::drop('Users');
    }
}
