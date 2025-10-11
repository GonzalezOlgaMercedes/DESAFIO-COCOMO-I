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

    private function obtenerCoeficientesSegunModoDesarrollo($modoDesarrollo)
    {
        switch ($modoDesarrollo) {
            case 'Orgánico':
                return [
                    'a'=>  2.4, 
                    'b'=> 1.05,
                    'c'=> 2.5,
                    'd'=> 0.38];
            case 'Semiorgánico':
                return [
                    'a'=> 3.0, 
                    'b'=> 1.12, 
                    'c'=> 2.5, 
                    'd'=> 0.35];
            case 'Empotrado':
                return [
                    'a'=> 3.6, 
                    'b'=> 1.20, 
                    'c'=> 2.5, 
                    'd'=> 0.32];
            default:
                throw new \InvalidArgumentException("Modo de desarrollo no válido");
                 }
    }
}