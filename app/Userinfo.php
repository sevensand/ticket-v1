<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Userinfo extends Model
{
  protected $table = 'userinfo';
  protected $fillable = [
      'employeeid', 'passportno', 'firstname', 'lastname', 'middlename', 'mobileno', 'department', 'datejoin',
  ];


}
