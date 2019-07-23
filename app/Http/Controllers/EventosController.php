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
            $Evento->estado = 1;
            $Evento->save();

            print true;
        } catch (\Exception $th) { 
            print $th;
        }      
    }

    public function getDataEventos(){
        $query = EventosModel::join('responsables','responsable','=','responsables.id_responsable')
                        ->join('estados','estado','=','id')
                        ->select('id_evento','accion','responsables.nombre','fecha_inicial','fecha_final','observaciones','estados.nombre as estado')
                        ->get();

        return $query;
    }

    public function getResponsables(){
        $query2 = DB::table('responsables')
                        //->join('eventos','responsable','=','id_Responsable')
                        ->select('id_Responsable as id','nombre')
                        ->where('responsables.activo','=',1)
                        ->get();
        $query = DB::table('eventos')
                    ->join('responsables','responsable','=','id_Responsable')
                    ->selectraw('distinct id_Responsable as id,nombre')
                    ->get();
    //    dd($query);
        return response()->json($query);
    }


    public function edit(){

        return view('Eventos.edit');
    } 

    public function showEvento(){
        return view('Eventos.agenda');
    }
    
    public function showBandeja(){
        return view('bandeja.bandeja');
    }

    
}
