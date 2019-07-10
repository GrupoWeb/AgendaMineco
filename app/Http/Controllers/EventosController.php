<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventosController extends Controller
{
    
    public function AddEventos(Request $request){
        $date = Carbon::now();
        $Evento = new EventosModel;
        try {
            $Evento->accion = $request->Accion_id;
            $Evento->responsable  = (int)$request->get('responsable_id');
            $Evento->fecha_inicial  = $date;
            $Evento->fecha_final  = $request->fecha;
            $Evento->observaciones  = $request->Dobservaciones;
            $Evento->activo  = 1;
            $Evento->estado = $request->idestado;
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
