@extends('layouts.base')
<style></style>
@section('content')
<div class="flex justify-center items-center altura-minima-toda-la-pantalla">
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
    <div class="shadow-lg p-8 altura-minima-toda-la-pantalla">
        <!-- ponemos el style para que sea en mayusculas -->
    <h1 class="text-2xl text-center mb-8 font-bold text-[#BF0034]" style="text-transform: uppercase;">Resultados de la Estimación - Modo Básico</h1>
    <div class="">
        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Modo de Desarrollo</p>
            <p>{{ $modo_de_desarrollo }}</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">KLOC (Miles de Líneas de Código)</p>
            <p>{{ $KLOC }}</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Sueldo por Persona (mensual)</p>
            <p>${{ number_format($sueldo_por_persona, 2) }}</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Nivel de Desarrollo</p>
            <p>{{ $nivel_de_desarrollo }}</p>
        </div>

        <div class="flex justify-between pt-2">
            <p class="font-semibold pr-4">Esfuerzo (Persona-Meses)</p>
            <p>{{ $esfuerzo_nominal }} (&asymp;{{ number_format($esfuerzo_nominal, 2) }})</p>
        </div>
        <div class="flex justify-between pb-2 pl-2">
            <p>{{ $formula_esfuerzo_nominal }}</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Cronograma (Meses)</p>
            <p>{{ $cronograma }} (&asymp;{{ number_format($cronograma, 2) }})</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Número de Personas</p>
            <p>{{ $numero_de_personas }} (&asymp; {{ ceil($numero_de_personas) }})</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Tiempo Real de Desarrollo (Meses)</p>
            <p>{{ $tiempo_real }} ({{ number_format($tiempo_real, 2) }})</p>
        </div>

        <div class="flex justify-between py-2">
            <p class="font-semibold pr-4">Costo Total del Proyecto</p>
            <p>${{ number_format($costo_total, 2) }}</p>
        </div>
    </div>

    <div class="flex justify-end py-2">
        <!-- botton regresar -->
        <a href="{{ route('registros') }}" class="inline-block bg-[#BF0034] text-white py-2 px-4 rounded hover:bg-[#A0002D]">
            Regresar
        </a>

    </div>
    </div>
</div>
@endsection