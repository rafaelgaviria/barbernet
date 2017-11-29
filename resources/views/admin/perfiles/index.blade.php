@extends('master')
@section('titulo','Listado de Perfiles')
@section('contenido')
		<div class="container">
				<h1>Listado Perfiles</h1>
				<a href="{{route('perfiles.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>Agregar perfil</a>
					<br><br>
				<table class="table table-striped">
						<thead>
								<tr>
										<th>ID</th>
										<th>Nombre</th>
										<th>Editar</th>
										<th>Borrar</th>
								</tr>
						</thead>
						<tbody>
							@foreach($perfiles as $perfil)
								<tr>
										<td>{{$perfil->id}}</td>
										<td>{{$perfil->nombre}}</td>
										<td><a href="{{route('perfiles.edit',$perfil->id)}}"><i class="fa fa-pencil fa-2x" aria-hidden="true"></i></a></td>
										<td>
											{!!Form::open(['route' => ['perfiles.destroy', $perfil->id]]) !!}
		        				<input type="hidden" name="_method" value="DELETE">
		        				<button onClick="return confirm('Eliminar perfil')" >
		        					<i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
		        				</button>
											{!! Form::close() !!} 
											</td>
								</tr>
								@endforeach
						</tbody>
				</table>
				{{ $perfiles->links() }}
		</div>
				
@endsection