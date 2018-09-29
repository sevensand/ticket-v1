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
            $table->string('employeeid');
            $table->string('passportno');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('mobileno');
            $table->string('department');
            $table->string('avatar');
            $table->date('passexp');
            $table->date('qidexp');
            $table->date('midexp');
            $table->date('datejoin');
            $table->string('username')->unique();
            $table->string('password');
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
