<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventosModel extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'accion', 'responsable', 'fecha_inicial', 'fecha_final', 'observaciones', 'activo'
    ];

    protected $table = 'eventos';
}


