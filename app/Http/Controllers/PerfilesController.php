<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perfil;

class PerfilesController extends Controller
{
	
		public function __construct(){
			$this->middleware(['auth','admin'],['except'=>'index']);
		}
	
		// Funcion para listar
		public function index()
		{
				$perfiles = Perfil::paginate(10);
				//return $perfiles;
				return view('admin.perfiles.index',compact('perfiles'));
		}

		// Funcion para crear un nuevo registro
		public function create()
		{
				return view('admin.perfiles.crear');
		}

		// Funcion para guardar los datos del nuevo registro
		public function store(Request $request)
		{
				$request->validate([
						'nombre' => 'required|unique:perfiles',
				]);
				Perfil::create([
						'nombre'=>$request->nombre
						]);
						
						return redirect()->route('perfiles.index');
		}

		// Funcion para mostrar
		public function show($id)
		{
				//
		}

		// Funcion para editar
		public function edit($id)
		{
				$perfil = Perfil::find($id);
				//return $perfil;
				return view('admin.perfiles.editar',compact('perfil'));
				
		}

		// Funcion para actualizar
		public function update(Request $request, $id)
		{
					$request->validate([
						'nombre' => 'required|unique:perfiles',
				]);
				
				$perfil = Perfil::find($id);
				$perfil -> nombre = $request->nombre;
				$perfil -> save();
				
				return redirect()->route('perfiles.index');
		}

		// Funcion para eliminar registro
		public function destroy($id)
		{
				$perfil = Perfil::find($id);
				$perfil -> delete();
				
				return redirect()->route('perfiles.index');
		}
}
