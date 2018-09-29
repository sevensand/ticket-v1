<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
  protected $table = 'announcement';
  protected $fillable = [
      'username', 'title', 'message', 'avatar', 'created_at'
  ];
}
