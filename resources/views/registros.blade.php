@extends('layouts.base')

@section('content')
    <h1 class="text-2xl text-center my-8 font-bold text-[#BF0034]">
        REGISTRO DE ESTIMACIONES REALIZADAS
    </h1>
<div class="px-4">
<table class="table-auto border-collapse border border-gray-400">
    <thead>
        <tr>
            <th class="border border-gray-300 px-2 py-2">ID</th>
            <th class="border border-gray-300 px-2 py-2">Modo de desarrollo</th>
            <th class="border border-gray-300 px-2 py-2">KLOC</th>
            <th class="border border-gray-300 px-2 py-2">Sueldo por persona</th>
            <th class="border border-gray-300 px-2 py-2">Nivel de desarrollo</th>
            <th class="border border-gray-300 px-2 py-2">Esfuerzo Nominal</th>
            <th class="border border-gray-300 px-2 py-2">Esfuerzo Ajustado</th>
            <th class="border border-gray-300 px-2 py-2">Cronograma</th>
            <th class="border border-gray-300 px-2 py-2">Tamaño del equipo</th>
            <th class="border border-gray-300 px-2 py-2">Tiempo real</th>
            <th class="border border-gray-300 px-2 py-2">Costo total</th>
            <th class="border border-gray-300 px-2 py-2">N° Factores</th>
            <th class="border border-gray-300 px-2 py-2">EAF</th>
            <th class="border border-gray-300 px-2 py-2"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $registro)
            <tr class="group">
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ $registro->id }}</a>
            </td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ $registro->estimacion["modo_de_desarrollo"] }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ $registro->estimacion["KLOC"] }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">${{ ceil($registro->estimacion["sueldo_por_persona"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ $registro->estimacion["nivel_de_desarrollo"] }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ ceil($registro->estimacion["esfuerzo_nominal"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ ceil($registro->estimacion["esfuerzo_ajustado"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ ceil($registro->estimacion["cronograma"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ ceil($registro->estimacion["numero_de_personas"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ ceil($registro->estimacion["tiempo_real"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">${{ ceil($registro->estimacion["costo_total"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ count($registro->estimacion["factores"]) }}</a></td>
                <td  class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100"><a href="{{ route('mostrar.registro', $registro->id) }}">{{ $registro->estimacion["EAF"] }}</a></td>
                <td class="border border-gray-300 px-2 py-2 group-hover:bg-gray-100 text-center">
                    <a class="text-red-500 hover:text-red-700" href="{{ route('eliminar.registro', $registro->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $registro->id }}').submit();">
                        <!-- ingresamos un svg -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" x="0px" y="0px" viewBox="0 0 30 30">
<path d="M6 8v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8H6zM24 4h-6c0-.6-.4-1-1-1h-4c-.6 0-1 .4-1 1H6C5.4 4 5 4.4 5 5s.4 1 1 1h18c.6 0 1-.4 1-1S24.6 4 24 4z"></path>
</svg>
                    </a>
                <form id="delete-form-{{ $registro->id }}" action="{{ route('eliminar.registro', $registro->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection