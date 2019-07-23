<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $fillable = [
        'id', 'message','user_id','evento_id'
    ];

    protected $table = 'messages';
}
 