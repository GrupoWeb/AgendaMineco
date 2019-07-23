<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\EventosModel;
use App\estado;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {

            $data = EventosModel::selectraw('accion,responsables.nombre,DATE_FORMAT(fecha_inicial, "%d-%m-%Y") as fecha_inicial,DATE_FORMAT(fecha_final, "%d-%m-%Y") as fecha_final')
                                ->join('responsables','eventos.responsable','=','responsables.id_Responsable')
                                ->where('eventos.activo','=',1)
                                ->get();

        //dd($data);
        // DB::table('PlantillasCBA')
        //                     ->selectraw('PlantillasCBA.NombrePlantilla,PlantillasCBA.created_at,categoriaCBA.nombre as categoria,productoCBA.nombre as produto,medida.nombre as medida') 
        //                     ->join('categoriaCBA','id_Categoria','=','idCategoria')
        //                     ->join('productoCBA','id_producto','=','idProducto')
        //                     ->join('medida','id_medida','=','idMedida')
        //                     ->join('NAME_TEMPLATE_CBA','NombreTemplate','=','NombrePlantilla')
        //                     ->where('NAME_TEMPLATE_CBA.id',$id)
        //                     ->get();

        return view('dashboard.home'); 
    }

    public function getEventos(){
        $data = EventosModel::selectraw('id_evento,accion,responsables.nombre,DATE_FORMAT(fecha_inicial, "%d-%m-%Y") as fecha_inicial,DATE_FORMAT(fecha_final, "%d-%m-%Y") as fecha_final,estados.nombre as estado')
                                ->join('estados','estado','=','id')
                                ->join('responsables','eventos.responsable','=','responsables.id_Responsable')
                                ->where('eventos.activo','=',1)
                                ->where('eventos.estado','=',1)
                                ->get();
        //print $data;
        return response()->json($data);
    }
   
    public function calendarEvent(){
        $estado = estado::all();

    
        return view('calendar.new',[
            'estado' => $estado,
        ]);
    }
}
