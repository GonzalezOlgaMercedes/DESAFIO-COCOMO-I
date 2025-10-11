<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class COCOMOController extends Controller
{
    //Función que recibe el modo de desarrollo seleccionado
    public function seleccionarModoDesarrollo(Request $request)
    {
        $request->validate([
            'modo_de_desarrollo' => 'required|in:"Orgánico","Semiorgánico","Empotrado"',
        ]);
        $modoDesarrollo = $request->input('modo_de_desarrollo');
        // Aquí puedes procesar el modo de desarrollo seleccionado
        echo "Modo de desarrollo seleccionado: " . $modoDesarrollo;
    }
}
