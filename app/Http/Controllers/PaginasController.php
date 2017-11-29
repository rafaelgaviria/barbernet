<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio; //Esto es como un include para probar si trae datos

class PaginasController extends Controller
{
    //Funcion para abrir la vista nosotros
    public function nosotros(){
        return view('nosotros');
    }
    public function productos(){
        return view('productos');
    }
    public function servicios(){
        //$servicio1 = "Tintura";
        //$servicio2 = "Corte";
        $servicios = Servicio::all();
        return view ('servicios', compact('servicios'));
    }
}
