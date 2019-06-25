<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Calendar;
use App\EventosModel;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        $data   = EventosModel::all();
 
        if($data->count())
        {
            foreach ($data as $key => $value)
            {
                //print($value);
                $events[] = Calendar::event(
                    $value->accion, true, new \DateTime($value->fecha_inicial), new \DateTime($value->fecha_final.' +1 day'), null,
                    ['color' => '#33ccff', 'url' => 'pass here url and any route',]
                );
            }
        }
        
        $calendar = Calendar::addEvents($events)->setCallbacks([
            'themeSystem' => '"bootstrap4"',
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
