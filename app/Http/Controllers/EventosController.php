<?php

namespace App\Http\Controllers;

use App\EventosModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\messages;
use App\Upload;

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
            $Evento->archivo= "";
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

    public function getDataResponsable(){
        $responsable = DB::table('responsables')
                            ->select('id_Responsable','nombre')
                            ->get();

        return response()->json($responsable);
    }

    public function edit($id){
        $user = $this->userLoginId();
        
        return view('Eventos.edit',[
         'id' => $id,
         'idUser' => $user
         ]);
    } 

    public function searchEvento($id){
        
        $query = EventosModel::join('responsables','responsable','=','id_Responsable')
                            ->select('accion','responsables.nombre as responsable','eventos.created_at','observaciones')
                            ->where('id_evento','1')->get();

        return response()->json($query);
    }

    public function chat($id){
        return view('Eventos.chat');
    }

    public function showEvento(){
        return view('Eventos.agenda');
    }
    
    public function showBandeja(){
        return view('bandeja.bandeja');
    }

    public function userLoginId(){
        $user = Auth::user()->id;
        return $user;
    }
    public function getMessages($id){       
        $message = messages::all();

        return response()->json($message);
    }

    public function addMessageData(Request $request){
        $Mensajes = new messages;

        $Mensajes->message = $request->message;
        $Mensajes->user_id = $request->id_user;
        $Mensajes->evento_id = $request->id_evento;

        $Mensajes->save();
    }

    public function uploadfile(Request $request){
        $modelUpload = Upload::find($request->id_file);

        $modelUpload->evento_id = $request->id_evento;

        $modelUpload->save();

        //dd($request->id_file)
;
        //$uploadData = Upload::find(1);

        //$uploadData->comments()->save($modelUpload);


        //dd($uploadData);
    }

    
}
