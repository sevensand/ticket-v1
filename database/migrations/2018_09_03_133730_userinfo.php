<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Userinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('userinfo', function (Blueprint $table) {
          $table->increments('id');
          $table->string('employeeid');
          $table->string('passportno');
          $table->string('firstname');
          $table->string('lastname');
          $table->string('middlename');
          $table->string('mobileno');
          $table->string('department');
          $table->date('datejoin');
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
        Schema::dropIfExists('userinfo');
    }
}
