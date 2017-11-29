<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicio;
use App\Estado;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ServicioCreado;

class ServiciosController extends Controller
{
    //Funcion para listar
    public function index(Request $request)
    {
        $servicios = Servicio::nombre($request->nombre)->precio($request->precio)->orderBy('nombre','asc')->paginate(10);
        //$servicios = Servicio::paginate(10);
        return view('admin.servicios.index',compact('servicios'));
    }

    //Función para crear un nuevo registro
    public function create()
    {
        $estados = Estado::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.servicios.crear',compact('estados'));
    }

    //Función para guardar los datos del nuevo registro
    public function store(Request $request)
    {
        //Validar datos
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
            'duracion' => 'required',
            'idestado' => 'required|numeric',
            'puntos' => 'required|numeric'
        ]);

        //Guardar los datos
        $servicio = Servicio::create([
            'nombre'=>$request->nombre,
            'precio'=>$request->precio,
            'descripcion'=>$request->descripcion,
            'duracion'=>$request->duracion,
            'idestado'=>$request->idestado,
            'puntos'=>$request->puntos
        ]);
        
        
        
        $nombreto = $request->nombre;
        $precioto = $request->precio;
        $emailto = Auth::user()->email;
        
        Mail::to($emailto)->send(new ServicioCreado($nombreto, $precioto, $emailto));

        $mensaje = $servicio?'Servicio creado correctamente':'El servicio no se creo';
        /*if($servicio){
            $mensaje = "Servicio OK";
        }else{
            $mensaje = "No se pudo guardar el Servicio";
        }*/
        return redirect()->route('servicios.index')->with('mensaje',$mensaje);

    }

    //Función para mostar información de un registro
    public function show($id)
    {
        //
    }

    //Función para mostrar el formulario de edición de un registro
    public function edit($id)
    {
        $servicio = Servicio::find($id);
        $estados = Estado::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.servicios.editar',compact('servicio','estados'));

    }

    //Función para actualizar los datos de un registro
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'required',
            'duracion' => 'required',
            'idestado' => 'required|numeric',
            'puntos' => 'required|numeric'
        ]);

        $servicio = Servicio::find($id);
        $servicio->nombre = $request->nombre;
        $servicio->precio = $request->precio;
        $servicio->descripcion = $request->descripcion;
        $servicio->duracion = $request->duracion;
        $servicio->idestado = $request->idestado;
        $servicio->puntos = $request->puntos;
        $servicio->save();

        return redirect()->route('servicios.index');

    }

    //Función para eliminar un registro
    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        $servicio->delete();

        $mensaje = $servicio?'Servicio borrado correctamente':'El servicio no se borró';

        return redirect()->route('servicios.index')->with('mensaje',$mensaje);
    }
}