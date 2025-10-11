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
            'sueldo_por_persona' => 'required|numeric|min:0',
            'nivel_de_desarrollo' => 'required|in:"Básico","Intermedio"',
        ]);
        $modoDesarrollo = $request->input('modo_de_desarrollo');
        // Aquí puedes procesar el modo de desarrollo seleccionado
        echo "<br>Modo de desarrollo seleccionado: " . $modoDesarrollo;

        //Recibir la cantidad de líneas de código
        $lineasDeCodigo = $request->input('KLOC');
        echo "<br>Cantidad de líneas de código: " . $lineasDeCodigo;

        //Recibir el sueldo por persona
        $sueldoPorPersona = $request->input('sueldo_por_persona');
        echo "<br>Sueldo estimado por persona: " . $sueldoPorPersona;

        //Obtener los coeficientes según el modo de desarrollo

        $coeficientesBasico = $this->obtenerCoeficientesDelModoBasico($modoDesarrollo);
        $a= $coeficientesBasico['a'];
        $b= $coeficientesBasico['b'];
        $c= $coeficientesBasico['c'];
        $d= $coeficientesBasico['d'];

        $esfuerzoNominal = $this->calcularEsfuerzoNominal($a, $b, $lineasDeCodigo);

        $EAF = 1; //Para el modo básico, EAF es siempre 1
        $esfuerzoAjustado = $this->calcularEsfuerzoAjustado($esfuerzoNominal, $EAF);
        $cronograma = $this->calcularCronograma($c, $d, $esfuerzoAjustado);
        $numeroDePersonas = $this->calcularNumeroDePersonas($esfuerzoAjustado, $cronograma);
        $tiempo_real = $this->tiempoRealDesarrollo($cronograma, $numeroDePersonas);
        $costoTotal = $this->calcularCostoTotal($tiempo_real, $sueldoPorPersona, $numeroDePersonas);
        //Recibir el nivel de desarrollo
        $nivelDeDesarrollo = $request->input('nivel_de_desarrollo');
        echo "<br>Nivel de desarrollo seleccionado: " . $nivelDeDesarrollo;
    }

    private function obtenerCoeficientesDelModoBasico($modoDesarrollo)
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
      private function obtenerCoeficientesDelModoIntermedio($modoDesarrollo)
    {
        switch ($modoDesarrollo) {
            case 'Orgánico':
                return [
                    'a'=>  3.2, 
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
                    'a'=> 2.8, 
                    'b'=> 1.20, 
                    'c'=> 2.5, 
                    'd'=> 0.32];
            default:
                throw new \InvalidArgumentException("Modo de desarrollo no válido");
                 }
    }
//Calculo de esfuerzo nominal , recibe a,b y KLOC
    private function calcularEsfuerzoNominal($a, $b, $KLOC) {
        return $a * pow($KLOC, $b);
}
//Calculo de esfuerzo ajustado , recibe esfuerzo nominal y EAF
    private function calcularEsfuerzoAjustado($esfuerzoNominal, $EAF) {
        return $esfuerzoNominal * $EAF;
    }
//Calculo del tiempo estimado, recibe c,d y esfuerzo ajustado
    private function calcularCronograma($c, $d, $esfuerzoAjustado) {
        return $c * pow($esfuerzoAjustado, $d);
    }
//Calculo del numero de personas que necesita el equipo, recibe esfuerzo ajustado y cronograma
    private function calcularNumeroDePersonas($esfuerzoAjustado, $cronograma) {
        return $esfuerzoAjustado / $cronograma;
    }
//Calculo del tiempo real de desarrollo por la cantidad de personas en el equipo, recibe cronograma y numero de personas
    private function tiempoRealDesarrollo($cronograma, $numeroDePersonas) {
        return $cronograma / $numeroDePersonas;
    }
//Calculo del costo total del proyecto, recibe tiempo real, sueldo por persona y tamaño del equipo
    private function calcularCostoTotal($tiempo_real, $sueldoPorPersona, $tamanio_del_equipo) {
        return $tiempo_real * $sueldoPorPersona * $tamanio_del_equipo;
    }
}