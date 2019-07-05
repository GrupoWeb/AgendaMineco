<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\EventosModel;
class DashboardController extends Controller
{
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
        $data = EventosModel::selectraw('accion,responsables.nombre,DATE_FORMAT(fecha_inicial, "%d-%m-%Y") as fecha_inicial,DATE_FORMAT(fecha_final, "%d-%m-%Y") as fecha_final')
                                ->join('responsables','eventos.responsable','=','responsables.id_Responsable')
                                ->where('eventos.activo','=',1)
                                ->get();
        //print $buson;
        return response()->json($data);
    }
   
    public function calendarEvent(){
        return view('calendar.new');
    }
}
