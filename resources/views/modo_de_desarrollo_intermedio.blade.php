<form method="POST" action="{{ route('modo-de-desarrollo') }}">
    @csrf
    <div>
        <!-- Selección del modo de desarrollo -->
        <label for="modo_de_desarrollo">Seleccione el modo de desarrollo:</label>
        <select name="modo_de_desarrollo" id="modo_de_desarrollo">
            <option value="Orgánico">Orgánico</option>
            <option value="Semiorgánico">Semiorgánico</option>
            <option value="Empotrado">Empotrado</option>
        </select>
    </div>

    <div>
        <!-- Ingreso del tamaño del proyecto -->
        <label for="KLOC">Ingrese el tamaño del proyecto (en KLOC):</label>
        <!-- Se considera en miles de líneas de código -->
        <input type="number" name="KLOC" required>
    </div>

    <div>
        <!-- Ingrese el sueldo por persona -->
        <label for="sueldo_por_persona">Ingrese el sueldo estimado por persona:</label>
        <input type="number" name="sueldo_por_persona" required>
    </div>

    <!-- Seleccionar el nivel de desarrollo -->
    <div hidden>
        <label for="nivel_de_desarrollo">Seleccione el nivel de desarrollo:</label>
        <select name="nivel_de_desarrollo" id="nivel_de_desarrollo">
            <option selected value="Intermedio">Intermedio</option>
        </select>
    </div>

    <!-- Seleccionar los factores de ajuste y su nivel de influencia -->
    <div>
        <div>
            <h3>ATRIBUTOS DEL PRODUCTO</h3>
            <!-- Confiabilidad requerida del software -->
            <label for="confiabilidad_requerida_del_software">Confiabilidad requerida del software:</label>
            <select name="confiabilidad_requerida_del_software" id="confiabilidad_requerida_del_software">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Tamaño de la base de datos -->
            <label for="tamanio_base_datos">Tamaño de la base de datos:</label>
            <select name="tamanio_base_datos" id="tamanio_base_datos">
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Complejidad del producto -->
            <label for="complejidad_del_producto">Complejidad del producto:</label>
            <select name="complejidad_del_producto" id="complejidad_del_producto">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>

        <h3>ATRIBUTOS DEL HARDWARE</h3>
        <div>
            <!-- Restricciones de tiempo de ejecución -->
            <label for="restricciones_de_tiempo_ejecucion">Restricciones de tiempo de ejecución:</label>
            <select name="restricciones_de_tiempo_ejecucion" id="restricciones_de_tiempo_ejecucion">
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>

        <div>
            <!-- Restricciones de memoria -->
            <label for="restricciones_de_memoria">Restricciones de memoria:</label>
            <select name="restricciones_de_memoria" id="restricciones_de_memoria">
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>

        <div>
            <!-- Volatilidad del entorno virtual (frecuencia de cambios HW/SW) -->
            <label for="volatilidad_del_entorno_virtual">Volatilidad del entorno virtual (frecuencia de cambios HW/SW):</label>
            <select name="volatilidad_del_entorno_virtual" id="volatilidad_del_entorno_virtual">
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Tiempo de respuesta requerido -->
            <label for="tiempo_de_respuesta_requerido">Tiempo de respuesta requerido:</label>
            <select name="tiempo_de_respuesta_requerido" id="tiempo_de_respuesta_requerido">
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <h3>ATRIBUTOS DEL PERSONAL</h3>
        <div>
            <!-- Capacidad de los analistas -->
            <label for="capacidad_de_los_analistas">Capacidad de los analistas:</label>
            <select name="capacidad_de_los_analistas" id="capacidad_de_los_analistas">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div>
            <!-- Capacidad de los programadores -->
            <label for="capacidad_de_los_programadores">Capacidad de los programadores:</label>
            <select name="capacidad_de_los_programadores" id="capacidad_de_los_programadores">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Experiencia en la aplicación -->
            <label for="experiencia_en_la_aplicacion">Experiencia en la aplicación:</label>
            <select name="experiencia_en_la_aplicacion" id="experiencia_en_la_aplicacion">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Experiencia en la máquina (plataforma HW/SW) -->
            <label for="experiencia_en_la_maquina">Experiencia en la máquina (plataforma HW/SW):</label>
            <select name="experiencia_en_la_maquina" id="experiencia_en_la_maquina">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <div>
            <!-- Experiencia en el lenguaje de programación -->
            <label for="experiencia_en_el_lenguaje_de_programacion">Experiencia en el lenguaje de programación:</label>
            <select name="experiencia_en_el_lenguaje_de_programacion" id="experiencia_en_el_lenguaje_de_programacion">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>

        <h3>ATRIBUTOS DEL PROYECTO</h3>
        <div>
            <!-- Uso de prácticas modernas (herramientas CASE, metodologías) -->
            <label for="uso_de_practicas_modernas">Uso de prácticas modernas (herramientas CASE, metodologías):</label>
            <select name="uso_de_practicas_modernas" id="uso_de_practicas_modernas">
                <option value="Muy Bajo">Muy Bajo</option>
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div>
            <!-- Uso de software reutilizable -->
            <label for="uso_de_software_reutilizable">Uso de software reutilizable:</label>
            <select name="uso_de_software_reutilizable" id="uso_de_software_reutilizable">
                <option value="Bajo">Bajo</option>
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
            </select>
        </div>
        <div>
            <!-- Restricciones de cronograma (presión de tiempo) -->
            <label for="restricciones_de_cronograma">Restricciones de cronograma (presión de tiempo):</label>
            <select name="restricciones_de_cronograma" id="restricciones_de_cronograma">
                <option value="Nominal">Nominal</option>
                <option value="Alto">Alto</option>
                <option value="Muy Alto">Muy Alto</option>
                <option value="Extra Alto">Extra Alto</option>
            </select>
        </div>
    </div>

    <button type="submit">ENVIAR</button>
</form>

{{-- Mostramos el error de laravel --}}
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