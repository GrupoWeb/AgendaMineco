<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estado extends Model
{
    protected $fillable = [
        'id', 'nombre'
    ];

    protected $table = 'estados';
}
