<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    
    public function AddEventos(Request $request){
        $Evento = new EventosModel;
        try {
            $Evento->accion = $request->Accion_id;
            $Evento->responsable  = (int)$request->get('responsable_id');
            $Evento->fecha_inicial  = $request->d;
            $Evento->fecha_final  = $request->a;
            $Evento->observaciones  = $request->Dobservaciones;
            $Evento->activo  = 1;
            $Evento->save();

            print true;
        } catch (\Exception $th) { 
            print $th;
        }      
    }

    public function showEvento(){
        return view('Eventos.agenda');
    }
    
}
