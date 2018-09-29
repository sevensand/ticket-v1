<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //
    protected $table = 'messages';
    protected $fillable = [
        'subject', 'message', 'message', 'avatar', 'id_from', 'id_user'
    ];
}
