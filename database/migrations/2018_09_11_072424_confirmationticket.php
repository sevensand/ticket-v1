<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Confirmationticket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('confirmationticket', function (Blueprint $table) {
          $table->increments('id');
          $table->string('employeeid');
          $table->date('dissued');
          $table->string('dlocation');
          $table->string('alocation');
          $table->date('ddate');
          $table->date('adate');
          $table->string('fileloc');
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
        //
    }
}
