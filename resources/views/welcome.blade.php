@extends('layouts.base')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Bienvenido a la Calculadora COCOMO</h1>
    <p>Utilice la barra de navegación para seleccionar el tipo de estimación que desea realizar:</p>
    <ul>
        <li><a href="{{ route('estimacion.basica') }}">Estimación Básica</a></li>
        <li><a href="{{ route('estimacion.intermedia') }}">Estimación Intermedia</a></li>
    </ul>
    <p>Seleccione una opción para comenzar con la estimación de su proyecto de software.</p>
</div>
@endsection