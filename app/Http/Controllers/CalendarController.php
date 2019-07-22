<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\EventosModel;

class CalendarController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $events = [];
        $data   = EventosModel::all();
 
        $locale = 'es';
        if($data->count())
        {
            foreach ($data as $key => $value)
            {
                //print($value);
                $description = $value->observaciones;
                $textColor = '#000';
                $events[] = Calendar::event(
                    $value->accion, false, new \DateTime($value->fecha_inicial), new \DateTime($value->fecha_final.' +1 day'), null,
                    [
                        'color' => '#33ccff', 
                        'url' => 'pass here url and any route',
                        'textColor' => $textColor,
                        'description' => $description,
                        
                    ]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events)->setOptions([
            
              'height' => 600,
              'minTime' => '08:00:00',
              'maxTime' => '20:00:00',
              'slotDuration' => '00:30:01',
              'locale' => 'es',
              'navLinks'=> true,
              'firstDay' => 1,
              'editable'    => false,
              'selectable'  => true,
              'themeSystem' =>'bootstrap4',
            
        ])->setCallbacks([
            
            'eventRender' => 'function(event, element) {
              element.popover({
                animation: true,
                html: true,
                content: $(element).html(),
                trigger: "hover"
                });
              }'
            ]);
        return view('calendar.calendario', compact('calendar'));
    }
}
// 'header'=>['left'=>'prev, next today', 'center'=>'title', 'right'=>'month, basicWeek, basicDay'],