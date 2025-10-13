@extends('layouts.base')
<style></style>
@section('content')
<div class="container mt-4 d-flex justify-content-center">
<!-- return view('calculo_nivel_intermedio', [
            'modo_de_desarrollo' => $modoDesarrollo,
            'KLOC' => $lineasDeCodigo,
            'sueldo_por_persona' => $sueldoPorPersona,
            'nivel_de_desarrollo' => $nivelDeDesarrollo,
            'esfuerzo_nominal' => $esfuerzoNominal,
            'esfuerzo_ajustado' => $esfuerzoAjustado,
            'cronograma' => $cronograma,
            'numero_de_personas' => $numeroDePersonas,
            'tiempo_real' => $tiempo_real,
            'costo_total' => $costoTotal,
            'factores' => $factores,
            'EAF' => $EAF,
        ]); -->
    <h2 class="mb-4">Resultados de la Estimación - Modo Básico</h2>
    <table class="table table-bordered">
        <tr>
            <th>Modo de Desarrollo</th>
            <td>{{ $modo_de_desarrollo }}</td>
        </tr>
        <tr>
            <th>KLOC (Miles de Líneas de Código)</th>
            <td>{{ $KLOC }}</td>
        </tr>
        <tr>
            <th>Sueldo por Persona (mensual)</th>
            <td>${{ number_format($sueldo_por_persona, 2) }}</td>
        </tr>
        <tr>
            <th>Nivel de Desarrollo</th>
            <td>{{ $nivel_de_desarrollo }}</td>
        </tr>
        <tr>
            <th>Esfuerzo (Persona-Meses)</th>
            <td>{{ $esfuerzo_nominal }} (&asymp;{{ number_format($esfuerzo_nominal, 2) }})</td>
            <td>{{ $formula_esfuerzo_nominal }}</td>
        </tr>
        <tr>
            <th>Cronograma (Meses)</th>
            <td>{{ $cronograma }} (&asymp;{{ number_format($cronograma, 2) }})</td>
        </tr>
        <tr>
            <th>Número de Personas</th>
            <td>{{ $numero_de_personas }} (&asymp; {{ ceil($numero_de_personas) }})</td>
        </tr>
        <tr>
            <th>Tiempo Real de Desarrollo (Meses)</th>
            <td>{{ $tiempo_real }} ({{ number_format($tiempo_real, 2) }})</td>
        </tr>
        <tr>
            <th>Costo Total del Proyecto</th>
            <td>${{ number_format($costo_total, 2) }}</td>
        </tr>
    </table>
</div>
@endsection