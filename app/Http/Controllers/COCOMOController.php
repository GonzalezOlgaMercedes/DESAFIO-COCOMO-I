<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class COCOMOController extends Controller
{
    //Función que recibe el modo de desarrollo seleccionado
    public function testearFormulario(Request $request)
    {
        $request->validate([
            'modo_de_desarrollo' => 'required|in:"Orgánico","Semiorgánico","Empotrado"',
            'KLOC' => 'required|integer|min:1',
        ]);
        $modoDesarrollo = $request->input('modo_de_desarrollo');
        // Aquí puedes procesar el modo de desarrollo seleccionado
        echo "<br>Modo de desarrollo seleccionado: " . $modoDesarrollo;

        //Recibir la cantidad de líneas de código
        $lineasDeCodigo = $request->input('KLOC');
        echo "<br>Cantidad de líneas de código: " . $lineasDeCodigo;
    }
}
