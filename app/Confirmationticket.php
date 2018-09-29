<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmationticket extends Model
{
  protected $table = 'confirmationticket';
  protected $fillable = [
      'employeeid', 'dissued', 'dlocation', 'alocation', 'ddate', 'adate', 'fileloc'
  ];
}
