@extends('layouts.base')

@section('content')
<div class="flex justify-center items-center altura-minima-toda-la-pantalla">
    <div class="shadow-lg p-8" style="border-radius: 15px;">
        <h1 class="text-2xl text-center mb-10 font-bold text-[#BF0034]">
            ESTIMACIÓN BÁSICA DEL PROYECTO
        </h1>

        <form method="POST" action="{{ route('modo-de-desarrollo') }}">
            @csrf

            {{-- Selección del modo de desarrollo --}}
            <div class="mb-3 flex justify-between">
                <label for="modo_de_desarrollo" class="form-label fw-semibold">Modo de desarrollo</label>
                <select name="modo_de_desarrollo" id="modo_de_desarrollo"
                        class="form-select shadow-sm" style="border: 1px solid #000;" required>
                    <option value="">-- Elegir --</option>
                    <option value="Orgánico">Orgánico</option>
                    <option value="Semiorgánico">Semiorgánico</option>
                    <option value="Empotrado">Empotrado</option>
                </select>
            </div>

            {{-- Tamaño del proyecto --}}
            <div class="mb-3 flex justify-between">
                <label for="KLOC" class="form-label fw-semibold">Tamaño del proyecto (en KLOC)</label>
                <input type="number" name="KLOC" id="KLOC"
                       class="form-control shadow-sm" style="border: 1px solid #000;"
                       placeholder="Ej: 50" required>
            </div>

            {{-- Sueldo por persona --}}
            <div class="mb-3 flex justify-between">
                <label for="sueldo_por_persona" class="form-label fw-semibold mr-6">Sueldo estimado por persona (mensual)</label>
                <input type="number" name="sueldo_por_persona" id="sueldo_por_persona"
                       class="form-control shadow-sm" style="border: 1px solid #000;"
                       placeholder="Ej: 500000" required>
            </div>

            {{-- Nivel oculto --}}
            <div hidden>
                <label for="nivel_de_desarrollo" class="form-label">Nivel de desarrollo</label>
                <select name="nivel_de_desarrollo" id="nivel_de_desarrollo" class="form-select">
                    <option selected value="Básico">Básico</option>
                </select>
            </div>

            {{-- Botón enviar --}}
            <div class="text-center mt-4">
                <button type="submit"
                    class="btn fw-bold px-5 py-2 text-white shadow cursor-pointer"
                    style="background: linear-gradient(90deg, #FE8828,#BF0034, #FE8828); border:none; border-radius: 3px;font-weight: bold;">
                    Enviar
                </button>
            </div>
        </form>

        {{-- Errores --}}
        @if ($errors->any())
            <div class="alert alert-danger mt-4">
                <h5 class="fw-bold">Por favor corrige los siguientes errores:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection
