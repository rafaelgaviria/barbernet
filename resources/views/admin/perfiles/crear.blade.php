@extends('master')
@section('titulo','Listado de Perfiles')
@section('contenido')
		<div class="container">
				<h1>Crear Nuevo Perfíl</h1>
				@include('parciales.errores')
					{!! Form::open(['route' => 'perfiles.store']) !!}
					<div class="form-group">
						
						{!! Form::label('Nombre') !!}
						{!! Form::text('nombre', null, [
							'class' => 'form-control',
							'placeholder'=> 'Ingrese el nuevo perfíl',
						])
						!!}
						
						<a href="{{route('perfiles.index')}}" style="" ></a>
					{!! Form::submit('Guardar', ['class'=>'btn btn-primary block'])!!}
						
					</div>
				{!! Form::close() !!}
		</div>
				
@endsection