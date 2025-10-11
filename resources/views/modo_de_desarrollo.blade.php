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
    <div>
        <label for="nivel_de_desarrollo">Seleccione el nivel de desarrollo:</label>
        <select name="nivel_de_desarrollo" id="nivel_de_desarrollo">
            <option value="Básico">Básico</option>
            <option value="Intermedio">Intermedio</option>
            <option value="Detallado">Detallado</option>
        </select>
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