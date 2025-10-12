@extends('layouts.base')

@section('content')
<div class="flex min-h-[calc(100vh-24*var(--spacing))] items-center justify-center gap-20">
    <!-- Card 1 -->
    <div class="group [perspective:1000px]">
        <div class="relative w-80 h-60 text-center transition-transform duration-500 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

            <!-- Frente -->
            <div class="absolute inset-0 bg-[#BF0034] rounded-xl shadow-lg flex flex-col items-center justify-center text-xl font-bold text-white [backface-visibility:hidden]]">
                <p>MODELO DE ESTIMACIÓN COCOMO I</p>
                <p>NIVEL BÁSICO</p>
            </div>

            <!-- Dorso -->
            <div class="absolute inset-0 bg-[#BF0034] text-white rounded-xl shadow-lg flex flex-col items-center justify-center gap-2 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                <p>-- NIVEL BÁSICO --</p>
                <p>MODO ORGÁNICO</p>
                <p>MODO SEMIORGÁNICO</p>
                <p>MODO EMPOTRADO</p>
                <a href="{{ route('estimacion.basica') }}" class="bg-white text-[#BF0034] px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Estimar Costos</a>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="group [perspective:1000px]">
        <div class="relative w-80 h-60 text-center transition-transform duration-500 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

            <!-- Frente -->
            <div class="absolute inset-0 bg-[#BF0034] rounded-xl shadow-lg flex flex-col items-center justify-center text-xl font-bold text-white [backface-visibility:hidden]">
                <p>MODELO DE ESTIMACIÓN COCOMO I</p>
                <p>NIVEL INTERMEDIO</p>
            </div>

            <!-- Dorso -->
            <div class="absolute inset-0 bg-[#BF0034] text-white rounded-xl shadow-lg flex flex-col items-center justify-center gap-2 [transform:rotateY(180deg)] [backface-visibility:hidden]">
                <p>-- NIVEL INTERMEDIO --</p>
                <p>MODO ORGÁNICO</p>
                <p>MODO SEMIORGÁNICO</p>
                <p>MODO EMPOTRADO</p>
                <p>incluye EAF</p>
                <a href="{{ route('estimacion.intermedia') }}" class="bg-white text-[#BF0034] px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">Estimar Costos</a>
            </div>
        </div>
    </div>
</div>
@endsection