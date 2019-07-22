<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EventosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
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
            $Evento->estado = "En Proceso";
            $Evento->save();

            print true;
        } catch (\Exception $th) { 
            print $th;
        }      
    }

    public function getDataEventos(){
        $query = EventosModel::join('responsables','responsable','=','responsables.id_responsable')
                        ->select('accion','responsables.nombre','fecha_inicial','fecha_final','observaciones','estado')
                        ->get();

        return $query;
    }

    public function getResponsables(){
        $query = DB::table('responsables')
                        ->select('id_Responsable as id','nombre')
                        ->where('activo','=',1)
                        ->get();
        return response()->json($query);
    }

    public function showEvento(){
        return view('Eventos.agenda');
    }
    
    public function showBandeja(){
        return view('bandeja.bandeja');
    }

    
}
