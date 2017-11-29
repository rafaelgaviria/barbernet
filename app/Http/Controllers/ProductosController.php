<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Estado;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ProductoCreado;

class ProductosController extends Controller
{
    //Funcion para listar
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('admin.productos.index',compact('productos'));
    }

    //Función para crear un nuevo registro
    public function create()
    {
        $estados = Estado::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.productos.crear',compact('estados'));
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
        $servicio = Producto::create([
            'nombre'=>$request->nombre,
            'precio'=>$request->precio,
            'descripcion'=>$request->descripcion,
            'idestado'=>$request->idestado,
            'puntos'=>$request->puntos
        ]);
        
        $nombreto = $request->nombre;
        $precioto = $request->precio;
        $emailto = Auth::user()->email;
        
        Mail::to($emailto)->send(new ProductoCreado($nombreto, $precioto, $emailto));
        

        $mensaje = $producto?'Servicio creado correctamente':'El servicio no se creo';
        /*if($servicio){
            $mensaje = "Servicio OK";
        }else{
            $mensaje = "No se pudo guardar el Servicio";
        }*/
        return redirect()->route('productos.index')->with('mensaje',$producto);

    }

    //Función para mostar información de un registro
    public function show($id)
    {
        //
    }

    //Función para mostrar el formulario de edición de un registro
    public function edit($id)
    {
        $servicio = Producto::find($id);
        $estados = Estado::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.productos.editar',compact('producto','estados'));

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

        $servicio = Producto::find($id);
        $servicio->nombre = $request->nombre;
        $servicio->precio = $request->precio;
        $servicio->descripcion = $request->descripcion;
        $servicio->duracion = $request->duracion;
        $servicio->idestado = $request->idestado;
        $servicio->puntos = $request->puntos;
        $servicio->save();

        return redirect()->route('productos.index');

    }

    //Función para eliminar un registro
    public function destroy($id)
    {
        $servicio = Producto::find($id);
        $servicio->delete();

        $mensaje = $producto?'Producto borrado correctamente':'El producto no se borró';

        return redirect()->route('productos.index')->with('mensaje',$producto);
    }
}