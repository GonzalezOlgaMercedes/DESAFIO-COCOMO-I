@extends('layouts.base')

@section('content')
<div class="flex justify-center">
     <div class="shadow-lg p-8" style="border-radius: 15px;">
        <h1 class="text-2xl text-center mb-10 font-bold text-[#BF0034]">
            ESTIMACIÓN INTERMEDIA DEL PROYECTO
        </h1>
<form method="POST" action="{{ route('modo-de-desarrollo') }}">
    @csrf
    <div class="mb-4 flex justify-between">
        <!-- Selección del modo de desarrollo -->
        <label for="modo_de_desarrollo">Seleccione el modo de desarrollo:</label>
        <select name="modo_de_desarrollo" id="modo_de_desarrollo" style="border: 1px solid #000;">
            <option value="Orgánico">Orgánico</option>
            <option value="Semiorgánico">Semiorgánico</option>
            <option value="Empotrado">Empotrado</option>
        </select>
    </div>

    <div class="mb-4 flex justify-between">
        <!-- Ingreso del tamaño del proyecto -->
        <label for="KLOC">Ingrese el tamaño del proyecto (en KLOC):</label>
        <input type="number" name="KLOC" required style="border: 1px solid #000;">
    </div>

    <div class="mb-4 flex justify-between">
        <!-- Ingrese el sueldo por persona -->
        <label for="sueldo_por_persona">Ingrese el sueldo estimado por persona:</label>
        <input type="number" name="sueldo_por_persona" required style="border: 1px solid #000;">
    </div>

    <div hidden class="mb-4 flex justify-between">
        <label for="nivel_de_desarrollo">Seleccione el nivel de desarrollo:</label>
        <select name="nivel_de_desarrollo" id="nivel_de_desarrollo" style="border: 1px solid #000;">
            <option selected value="Intermedio">Intermedio</option>
        </select>
    </div>

<!-- Lista de Factores de Ajuste a aplicar en el nivel Intermedio -->
    <div>
        <div>
            <!-- ATRIBUTOS DEL PRODUCTO -->
            <h3 class="mt-2 border-t border-gray-300 pt-2 font-bold">ATRIBUTOS DEL PRODUCTO</h3>
            <div class="mb-4 flex justify-between">
                <label for="confiabilidad_requerida_del_software">(RELY) Confiabilidad requerida del software:</label>
                <select name="confiabilidad_requerida_del_software" id="confiabilidad_requerida_del_software" style="border: 1px solid #000;">
                    <option value="Muy Bajo">Muy Bajo</option>
                    <option value="Bajo">Bajo</option>
                    <option value="Nominal" selected >Nominal</option>
                    <option value="Alto">Alto</option>
                    <option value="Muy Alto">Muy Alto</option>
                </select>
            </div>
            <div class="mb-4 flex justify-between">
                <label for="tamanio_base_datos">(DATA) Tamaño de la base de datos:</label>
                <select name="tamanio_base_datos" id="tamanio_base_datos" style="border: 1px solid #000;">
                    <option value="Bajo">Bajo</option>
                    <option value="Nominal" selected >Nominal</option>
                    <option value="Alto">Alto</option>
                    <option value="Muy Alto">Muy Alto</option>
                </select>
            </div>
            <div class="mb-4 flex justify-between">
                <label for="complejidad_del_producto">(CPLX) Complejidad del producto:</label>
                <select name="complejidad_del_producto" id="complejidad_del_producto" style="border: 1px solid #000;">
                    <option value="Muy Bajo">Muy Bajo</option>
                    <option value="Bajo">Bajo</option>
                    <option value="Nominal" selected >Nominal</option>
                    <option value="Alto">Alto</option>
                    <option value="Muy Alto">Muy Alto</option>
                    <option value="Extra Alto">Extra Alto</option>
                </select>
            </div>
        </div>
        <!-- ATRIBUTOS DEL HARDWARE -->
        <h3 class="mt-2 border-t border-gray-300 pt-2 font-bold">ATRIBUTOS DEL HARDWARE</h3>
        <div class="mb-4 flex justify-between">
            <label for="restricciones_de_tiempo_ejecucion">(TIME) Restricciones de tiempo de ejecución:</label>
            <select name="restricciones_de_tiempo_ejecucion" id="restricciones_de_tiempo_ejecucion" style="border: 1px solid #000;">
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="restricciones_de_memoria">(STOR) Restricciones de memoria:</label>
            <select name="restricciones_de_memoria" id="restricciones_de_memoria" style="border: 1px solid #000;">
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="volatilidad_del_entorno_virtual">(VIRT) Volatilidad del entorno virtual (frecuencia de cambios HW/SW):</label>
            <select name="volatilidad_del_entorno_virtual" id="volatilidad_del_entorno_virtual" style="border: 1px solid #000;">
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="tiempo_de_respuesta_requerido">(TURN) Tiempo de respuesta requerido:</label>
            <select name="tiempo_de_respuesta_requerido" id="tiempo_de_respuesta_requerido" style="border: 1px solid #000;">
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <!-- ATRIBUTOS DEL PERSONAL INVOLUCRADO EN EL PROYECTO -->
        <h3 class="mt-2 border-t border-gray-300 pt-2 font-bold">ATRIBUTOS DEL PERSONAL</h3>
        <div class="mb-4 flex justify-between">
            <label for="capacidad_de_los_analistas">(ACAP) Capacidad de los analistas:</label>
            <select name="capacidad_de_los_analistas" id="capacidad_de_los_analistas" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="capacidad_de_los_programadores">(PCAP) Capacidad de los programadores:</label>
            <select name="capacidad_de_los_programadores" id="capacidad_de_los_programadores" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="experiencia_en_la_aplicacion">(AEXP) Experiencia en aplicaciones similares:</label>
            <select name="experiencia_en_la_aplicacion" id="experiencia_en_la_aplicacion" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="experiencia_en_la_maquina">(VEXP) Experiencia en la máquina virtual (plataforma HW/SW):</label>
            <select name="experiencia_en_la_maquina" id="experiencia_en_la_maquina" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="experiencia_en_el_lenguaje_de_programacion">(LEXP) Experiencia en el lenguaje de programación:</label>
            <select name="experiencia_en_el_lenguaje_de_programacion" id="experiencia_en_el_lenguaje_de_programacion" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <!-- ATRIBUTOS DEL PROYECTO -->
        <h3 class="mt-2 border-t border-gray-300 pt-2 font-bold">ATRIBUTOS DEL PROYECTO</h3>
        <div class="mb-4 flex justify-between">
            <label class="mr-4" for="uso_de_practicas_modernas">(MODP) Uso de prácticas modernas (herramientas CASE, metodologías):</label>
            <select name="uso_de_practicas_modernas" id="uso_de_practicas_modernas" style="border: 1px solid #000;">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="uso_de_software_reutilizable">(TOOL) Uso de software reutilizable:</label>
            <select name="uso_de_software_reutilizable" id="uso_de_software_reutilizable" style="border: 1px solid #000;">
                <option value="Bajo">Bajo</option>
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div class="mb-4 flex justify-between">
            <label for="restricciones_de_cronograma">(SCED) Restricciones de cronograma (presión de tiempo):</label>
            <select name="restricciones_de_cronograma" id="restricciones_de_cronograma" style="border: 1px solid #000;">
                <option value="Nominal" selected >Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>
    </div>

    {{-- Botón enviar --}}
    <div class="text-center mt-4">
        <button type="submit"
            class="btn fw-bold px-5 py-2 text-white shadow"
            style="background: linear-gradient(90deg, #FE8828,#BF0034, #FE8828); border:none; border-radius: 3px;font-weight: bold">
            Enviar
        </button>
    </div>
</form>

{{-- Mostramos el error de laravel --}}
<div class="mb-4">
    <p>
        @if ($errors->any())
        <div>
            <h4>Por favor corrige los siguientes errores:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </p>
</div>
</div>
</div>
@endsection