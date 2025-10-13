@extends('layouts.base')

@section('content')
<!-- Formulas:
formula_esfuerzo_nominal  
formula_esfuerzo_ajustado  
formula_cronograma  
formula_numero_de_personas  
formula_tiempo_real  
formula_costo_total
 
-->
<div class="flex justify-center items-center altura-minima-toda-la-pantalla">
    <div class="shadow-lg p-8 altura-minima-toda-la-pantalla">
        <h1 class="text-2xl text-center mb-8 font-bold text-[#BF0034]" style="text-transform: uppercase;">Resultados de la Estimación - Modo Intermedio</h1>
        
        <div class="">
            <h2 class="uppercase text-xl font-bold text-[#BF0034] text-center">Datos Iniciales</h2>
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

            <div class="mt-8 border-t border-gray-300 pt-4">
                <h2 class="uppercase text-xl font-bold text-[#BF0034] text-center">Datos Calculados</h2>
            </div>
            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Esfuerzo Nominal (Persona-Meses)</p>
                <p>{{ $esfuerzo_nominal }} (&asymp;{{ number_format($esfuerzo_nominal, 2) }})</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_esfuerzo_nominal }}</p>
            </div>

            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Esfuerzo Ajustado (Persona-Meses)</p>
                <p>{{ $esfuerzo_ajustado }} (&asymp;{{ number_format($esfuerzo_ajustado, 2) }})</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_esfuerzo_ajustado }}</p>
            </div>

            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Cronograma (Meses)</p>
                <p>{{ $cronograma }} (&asymp;{{ number_format($cronograma, 2) }})</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_cronograma }}</p>
            </div>

            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Número de Personas</p>
                <p>{{ $numero_de_personas }} (&asymp; {{ ceil($numero_de_personas) }})</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_numero_de_personas }}</p>
            </div>

            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Tiempo Real de Desarrollo (Meses)</p>
                <p>{{ $tiempo_real }} ({{ number_format($tiempo_real, 2) }})</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_tiempo_real }}</p>
            </div>

            <div class="flex justify-between pt-2">
                <p class="font-semibold pr-4">Costo Total del Proyecto</p>
                <p>${{ number_format($costo_total, 2) }}</p>
            </div>
            <div class="flex justify-between pb-2 pl-2">
                <p>{{ $formula_costo_total }}</p>
            </div>
        </div>

        @if(count($factores) > 0)
            <div class="mt-8 border-t border-gray-300 pt-4">
                <h2 class="uppercase text-xl font-bold text-[#BF0034] mb-2">Productoria de Factores de Ajuste</h2>
                <p>EAF = {{ implode(' x ', array_map(function($factor) {
                return $factor['valor'];
            }, $factores)) }}{{ number_format(array_product(array_column($factores, 'valor')), 2) }}</p>
            <p><strong>EAF (Factor de Ajuste del Esfuerzo):</strong> {{ number_format($EAF, 2) }}</p>
            </div>
            
            <div class="mt-6">
                <h2 class="uppercase text-xl font-bold text-[#BF0034] mb-2">Factores Aplicados</h2>
                <ul class="list-disc pl-5">
                    @foreach ($factores as $factor)
                    <li>{{ $factor['nombre'] }}: {{ $factor['valor'] }}</li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="mt-8 border-t border-gray-300 pt-4 text-center">
                <h2 class="uppercase text-lg font-bold text-[#BF0034] mb-2">No se aplicaron factores de ajuste</h2>
            </div>
        @endif

        <div class="flex justify-end py-4">
            <a href="{{ route('registros') }}" class="inline-block bg-[#BF0034] text-white py-2 px-4 rounded hover:bg-[#A0002D]">
                Regresar
            </a>
        </div>
    </div>
</div>
@endsection
