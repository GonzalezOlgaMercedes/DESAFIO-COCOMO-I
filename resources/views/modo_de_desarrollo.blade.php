<form method="POST" action="{{ route('modo-de-desarrollo') }}">
    @csrf
    <label for="modo_de_desarrollo">Seleccione el modo de desarrollo:</label>
    <select name="modo_de_desarrollo" id="modo_de_desarrollo">
        <option value="Orgánico">Orgánico</option>
        <option value="Semiorgánico">Semiorgánico</option>
        <option value="Empotrado">Empotrado</option>
    </select>
    <button type="submit">ENVIAR</button>
</form>
<p>
    {{-- Mostramos el error de laravel --}}
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