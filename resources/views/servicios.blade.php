@extends('master')
@section('titulo','Nosotros')
@section('contenido')
    <h1>Servicios</h1>
    <p>Estos son nuestros servicios y precios:</p>
    <ul>
        @foreach($servicios as $servicio)
        <li>
            {{$servicio->nombre}} - ${{$servicio->precio}}
        </li>
        @endforeach
    </ul>
@endsection