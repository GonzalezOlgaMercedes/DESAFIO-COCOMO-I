@extends('layouts.base')

@section('content')
<table class="table-fixed border-collapse border border-gray-400">
    <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">ID</th>
            <th class="border border-gray-300 px-4 py-2">Modo de desarrollo</th>
            <th class="border border-gray-300 px-4 py-2">KLOC</th>
            <th class="border border-gray-300 px-4 py-2">Sueldo por persona</th>
            <th class="border border-gray-300 px-4 py-2">Nivel de desarrollo</th>
            <th class="border border-gray-300 px-4 py-2">Esfuerzo Nominal</th>
            <th class="border border-gray-300 px-4 py-2">Esfuerzo Ajustado</th>
            <th class="border border-gray-300 px-4 py-2">Cronograma</th>
            <th class="border border-gray-300 px-4 py-2">Tamaño del equipo</th>
            <th class="border border-gray-300 px-4 py-2">Tiempo real</th>
            <th class="border border-gray-300 px-4 py-2">Costo total</th>
            <th class="border border-gray-300 px-4 py-2">Cantidad de Factores</th>
            <th class="border border-gray-300 px-4 py-2">EAF</th>
        </tr>
    </thead>
    <tbody>
        @foreach($registros as $registro)
            <tr>
                <td  class="border border-gray-300 px-4 py-2">{{ $registro->id }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ $registro->estimacion["modo_de_desarrollo"] }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ $registro->estimacion["KLOC"] }}</td>
                <td  class="border border-gray-300 px-4 py-2">${{ ceil($registro->estimacion["sueldo_por_persona"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ $registro->estimacion["nivel_de_desarrollo"] }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ ceil($registro->estimacion["esfuerzo_nominal"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ ceil($registro->estimacion["esfuerzo_ajustado"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ ceil($registro->estimacion["cronograma"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ ceil($registro->estimacion["numero_de_personas"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ ceil($registro->estimacion["tiempo_real"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">${{ ceil($registro->estimacion["costo_total"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ count($registro->estimacion["factores"]) }}</td>
                <td  class="border border-gray-300 px-4 py-2">{{ $registro->estimacion["EAF"] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection