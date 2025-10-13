<?php

namespace App\Http\Controllers;

use App\Models\RegistroEstimacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class COCOMOController extends Controller
{
    //Función que recibe el modo de desarrollo seleccionado
    public function testearFormulario(Request $request)
    {
        $request->validate([
            'modo_de_desarrollo' => 'required|in:"Orgánico","Semiorgánico","Empotrado"',
            'KLOC' => 'required|integer|min:0',
            'sueldo_por_persona' => 'required|numeric|min:0',
            'nivel_de_desarrollo' => 'required|in:"Básico","Intermedio"',
        ]);
        $modoDesarrollo = $request->input('modo_de_desarrollo');
        $nivelDeDesarrollo = $request->input('nivel_de_desarrollo');


        //Recibir la cantidad de líneas de código
        $lineasDeCodigo = $request->input('KLOC');

        //Recibir el sueldo por persona
        $sueldoPorPersona = $request->input('sueldo_por_persona');

        //Obtener los coeficientes según el modo de desarrollo
        if($nivelDeDesarrollo == "Básico"){

            $coeficientesBasico = $this->obtenerCoeficientesDelModoBasico($modoDesarrollo);
        }
        else {
            $coeficientesBasico = $this->obtenerCoeficientesDelModoIntermedio($modoDesarrollo);
        }
        $a= $coeficientesBasico['a'];
        $b= $coeficientesBasico['b'];
        $c= $coeficientesBasico['c'];
        $d= $coeficientesBasico['d'];

        $esfuerzoNominal = $this->calcularEsfuerzoNominal($a, $b, $lineasDeCodigo);
        $factores = [];
        $EAF = 1.00;

        //Si el nivel de desarrollo es intermedio, calcular el EAF
        if($nivelDeDesarrollo == "Intermedio"){

            $factores = $this->obtenerFactores($request);
            
            //filtramos los factores nulos y nominales
            $factores = array_filter($factores, function($factor) {
                return $factor['valor'] !== null && $factor['valor'] !== 1.00;
            });
            
            $EAF = $this->calcularEAFDesdeFactores($factores);
        }

        $esfuerzoAjustado = $this->calcularEsfuerzoAjustado($esfuerzoNominal, $EAF);
        $cronograma = $this->calcularCronograma($c, $d, $esfuerzoAjustado);
        $numeroDePersonas = $this->calcularNumeroDePersonas($esfuerzoAjustado, $cronograma);
        $tiempo_real = $this->tiempoRealDesarrollo($cronograma, $numeroDePersonas);
        $costoTotal = $this->calcularCostoTotal($esfuerzoAjustado, $sueldoPorPersona);

        $datos = [
                    'modo_de_desarrollo' => $modoDesarrollo,
                    'KLOC' => $lineasDeCodigo,
                    'sueldo_por_persona' => $sueldoPorPersona,
                    'nivel_de_desarrollo' => $nivelDeDesarrollo,
                    'esfuerzo_nominal' => $esfuerzoNominal,
                    'formula_esfuerzo_nominal' => $this->mostrarFormulaEsfuerzoNominal($a, $b, $lineasDeCodigo),
                    'esfuerzo_ajustado' => $esfuerzoAjustado,
                    'cronograma' => $cronograma,
                    'numero_de_personas' => $numeroDePersonas,
                    'tiempo_real' => $tiempo_real,
                    'costo_total' => $costoTotal,
                    'factores' => $factores,
                    'EAF' => $EAF,
                    'formula_esfuerzo_ajustado' => $this->mostrarFormulaEsfuerzoAjustado($esfuerzoNominal, $EAF),
                    'formula_cronograma' => $this->mostrarFormulaCronograma($c, $d, $esfuerzoAjustado),
                    'formula_numero_de_personas' => $this->mostrarFormulaNumeroDePersonas($esfuerzoAjustado, $cronograma),
                    'formula_tiempo_real' => $this->mostrarFormulaTiempoRealDesarrollo($cronograma, $numeroDePersonas),
                    'formula_costo_total' => $this->mostrarFormulaCostoTotal($esfuerzoAjustado, $sueldoPorPersona),
        ];
        //guardamos en la base de datos antes de enviar a la vista
        $registro = RegistroEstimacion::create([
            'estimacion' => $datos
        ]);
        //Recibir el nivel de desarrollo
        if($nivelDeDesarrollo == "Básico"){
                return view('calculo_nivel_basico', $datos);
            }

        return view('calculo_nivel_intermedio', $datos);
    }
    //Calculo de los coeficientes a,b,c y d según el modo de desarrollo
    private function obtenerCoeficientesDelModoBasico($modoDesarrollo)
    {
        switch ($modoDesarrollo) {
            case 'Orgánico':
                return [
                    'a' =>  2.4,
                    'b' => 1.05,
                    'c' => 2.5,
                    'd' => 0.38
                ];
            case 'Semiorgánico':
                return [
                    'a' => 3.0,
                    'b' => 1.12,
                    'c' => 2.5,
                    'd' => 0.35
                ];
            case 'Empotrado':
                return [
                    'a' => 3.6,
                    'b' => 1.20,
                    'c' => 2.5,
                    'd' => 0.32
                ];
            default:
                throw new \InvalidArgumentException("Modo de desarrollo no válido");
        }
    }
    private function obtenerCoeficientesDelModoIntermedio($modoDesarrollo)
    {
        switch ($modoDesarrollo) {
            case 'Orgánico':
                return [
                    'a' =>  3.2,
                    'b' => 1.05,
                    'c' => 2.5,
                    'd' => 0.38
                ];
            case 'Semiorgánico':
                return [
                    'a' => 3.0,
                    'b' => 1.12,
                    'c' => 2.5,
                    'd' => 0.35
                ];
            case 'Empotrado':
                return [
                    'a' => 2.8,
                    'b' => 1.20,
                    'c' => 2.5,
                    'd' => 0.32
                ];
            default:
                throw new \InvalidArgumentException("Modo de desarrollo no válido");
        }
    }
//Cálculo de Esfuerzo nominal , recibe a,b y KLOC
    private function calcularEsfuerzoNominal($a, $b, $KLOC) {
        return floor($a *pow($KLOC, $b)*100)/100;
    }
//Mostrar la fórmula de esfuerzo nominal
    private function mostrarFormulaEsfuerzoNominal($a, $b, $KLOC):string {
        return "PMnominal = $a * $KLOC ^ $b";
    }
//Cálculo de esfuerzo ajustado , recibe esfuerzo nominal y EAF
    private function calcularEsfuerzoAjustado($esfuerzoNominal, $EAF) {
        return $esfuerzoNominal * $EAF ;
    }
//Mostrar la fórmula de esfuerzo ajustado
    private function mostrarFormulaEsfuerzoAjustado($esfuerzoNominal, $EAF): string {
        return "PMajustado = $esfuerzoNominal × $EAF";
    }
//Cálculo del tiempo estimado, recibe c,d y esfuerzo ajustado
    private function calcularCronograma($c, $d, $esfuerzoAjustado){
        return $c * pow($esfuerzoAjustado, $d);
    }
//Mostrar la fórmula del cronograma
    private function mostrarFormulaCronograma($c, $d, $esfuerzoAjustado): string {
        return "TDEV = $c × ($esfuerzoAjustado ^ $d)";
    }
//Cálculo del número de personas que necesita el equipo, recibe esfuerzo ajustado y cronograma
    private function calcularNumeroDePersonas($esfuerzoAjustado, $cronograma){
        return $esfuerzoAjustado / $cronograma;
    }
//Mostrar la fórmula del número de personas necesarias para el proyecto
    private function mostrarFormulaNumeroDePersonas($esfuerzoAjustado, $cronograma): string {
        return "P = $esfuerzoAjustado ÷ $cronograma";
    }
//Cálculo del tiempo real de desarrollo por la cantidad de personas en el equipo, recibe cronograma y numero de personas
    private function tiempoRealDesarrollo($cronograma, $numeroDePersonas){
        return $cronograma / $numeroDePersonas;
    }
//Mostrar la fórmula del tiempo real de desarrollo
    private function mostrarFormulaTiempoRealDesarrollo($cronograma, $numeroDePersonas): string {
        return "TDEVreal = $cronograma ÷ $numeroDePersonas";
    }
//Cálculo del costo total del proyecto, recibe tiempo real, sueldo por persona y tamaño del equipo
    private function calcularCostoTotal($calcular_esfuerzo_ajustado, $sueldoPorPersona) {
        return $calcular_esfuerzo_ajustado * $sueldoPorPersona;
    }
//Mostrar la fórmula del costo total
    private function mostrarFormulaCostoTotal($esfuerzoAjustado, $sueldoPorPersona): string {
        return "C = $esfuerzoAjustado × $sueldoPorPersona";
    }

    //Función para obtener los factores de costo desde el request para el nivel intermedio
    private function obtenerFactores(Request $request)
    {
        $factores = [];
        //Atributos del producto
        if ($request->has(('confiabilidad_requerida_del_software'))) {
            $factor = [
                "Muy Bajo" => 0.75,
                "Bajo" => 0.88,
                "Nominal" => 1.00,
                "Alto" => 1.15,
                "Muy Alto" => 1.40,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Confiabilidad requerida del software",
                "valor" => $factor[$request->input('confiabilidad_requerida_del_software')]
            ];
        }
        if ($request->has(('tamanio_base_datos'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => 0.94,
                "Nominal" => 1.00,
                "Alto" => 1.08,
                "Muy Alto" => 1.16,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Tamaño de la base de datos",
                "valor" => $factor[$request->input('tamanio_base_datos')]
            ];
        }
        if ($request->has(('complejidad_del_producto'))) {
            $factor = [
                "Muy Bajo" => 0.70,
                "Bajo" => 0.85,
                "Nominal" => 1.00,
                "Alto" => 1.15,
                "Muy Alto" => 1.30,
                "Extra Alto" => 1.65
            ];
            $factores[] = [
                "nombre" => "Complejidad del producto",
                "valor" => $factor[$request->input('complejidad_del_producto')]
            ];
        }
        //Atributos del hardware
        if ($request->has(('restricciones_de_tiempo_ejecucion'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => null,
                "Nominal" => 1.00,
                "Alto" => 1.11,
                "Muy Alto" => 1.30,
                "Extra Alto" => 1.66
            ];
            $factores[] = [
                "nombre" => "Restricciones de tiempo de ejecución",
                "valor" => $factor[$request->input('restricciones_de_tiempo_ejecucion')]
            ];
        }
        if ($request->has(('restricciones_de_memoria'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => null,
                "Nominal" => 1.00,
                "Alto" => 1.06,
                "Muy Alto" => 1.21,
                "Extra Alto" => 1.56
            ];
            $factores[] = [
                "nombre" => "Restricciones de memoria",
                "valor" => $factor[$request->input('restricciones_de_memoria')]
            ];
        }
        if ($request->has(('volatilidad_del_entorno_virtual'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => 0.87,
                "Nominal" => 1.00,
                "Alto" => 1.15,
                "Muy Alto" => 1.30,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Volatilidad del entorno virtual",
                "valor" => $factor[$request->input('volatilidad_del_entorno_virtual')]
            ];
        }
        if ($request->has(('tiempo_de_respuesta_requerido'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => 0.87,
                "Nominal" => 1.00,
                "Alto" => 1.07,
                "Muy Alto" => 1.15,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Tiempo de respuesta requerido",
                "valor" => $factor[$request->input('tiempo_de_respuesta_requerido')]
            ];
        }
        //Atributos del personal

        if ($request->has(('capacidad_de_los_analistas'))) {
            $factor = [
                "Muy Bajo" => 1.46,
                "Bajo" => 1.19,
                "Nominal" => 1.00,
                "Alto" => 0.86,
                "Muy Alto" => 0.71,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Capacidad de los analistas",
                "valor" => $factor[$request->input('capacidad_de_los_analistas')]
            ];
        }

        if ($request->has(('capacidad_de_los_programadores'))) {
            $factor = [
                "Muy Bajo" => 1.42,
                "Bajo" => 1.17,
                "Nominal" => 1.00,
                "Alto" => 0.86,
                "Muy Alto" => 0.70,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Capacidad de los programadores",
                "valor" => $factor[$request->input('capacidad_de_los_programadores')]
            ];
        }

        if ($request->has(('experiencia_en_la_aplicacion'))) {
            $factor = [
                "Muy Bajo" => 1.29,
                "Bajo" => 1.13,
                "Nominal" => 1.00,
                "Alto" => 0.91,
                "Muy Alto" => 0.82,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Experiencia en la aplicación",
                "valor" => $factor[$request->input('experiencia_en_la_aplicacion')]
            ];
        }

        if ($request->has(('experiencia_en_la_maquina'))) {
            $factor = [
                "Muy Bajo" => 1.21,
                "Bajo" => 1.10,
                "Nominal" => 1.00,
                "Alto" => 0.90,
                "Muy Alto" => 0.80,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Experiencia en la máquina",
                "valor" => $factor[$request->input('experiencia_en_la_maquina')]
            ];
        }
        if ($request->has(('experiencia_en_el_lenguaje_de_programacion'))) {
            $factor = [
                "Muy Bajo" => 1.14,
                "Bajo" => 1.07,
                "Nominal" => 1.00,
                "Alto" => 0.95,
                "Muy Alto" => 0.91,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Experiencia en el lenguaje de programación",
                "valor" => $factor[$request->input('experiencia_en_el_lenguaje_de_programacion')]
            ];
        }
        // Atributos del proyecto
        if ($request->has(('uso_de_practicas_modernas'))) {
            $factor = [
                "Muy Bajo" => 1.24,
                "Bajo" => 1.10,
                "Nominal" => 1.00,
                "Alto" => 0.91,
                "Muy Alto" => 0.82,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Uso de prácticas modernas",
                "valor" => $factor[$request->input('uso_de_practicas_modernas')]
            ];
        }

        if ($request->has(('uso_de_software_reutilizable'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => 0.95,
                "Nominal" => 1.00,
                "Alto" => 1.07,
                "Muy Alto" => 0.15,
                "Extra Alto" => null
            ];
            $factores[] = [
                "nombre" => "Uso de software reutilizable",
                "valor" => $factor[$request->input('uso_de_software_reutilizable')]
            ];
        }

        if ($request->has(('restricciones_de_cronograma'))) {
            $factor = [
                "Muy Bajo" => null,
                "Bajo" => null,
                "Nominal" => 1.00,
                "Alto" => 1.04,
                "Muy Alto" => 1.10,
                "Extra Alto" => 1.23
            ];
            $factores[] = [
                "nombre" => "Restricciones de cronograma (presión de tiempo)",
                "valor" => $factor[$request->input('restricciones_de_cronograma')]
            ];
            return $factores;
        }
    }
    //Función para calcular el EAF a partir de los factores seleccionados
    private function calcularEAFDesdeFactores($factores)
    {
        $EAF = 1.0;
        foreach ($factores as $factor) {
            if ($factor['valor'] !== null) {
                $EAF *= $factor['valor'];
            }
        }
        return round($EAF,2);
    }

    //Función para mostrar los registros de estimaciones
    public function mostrarRegistros()
    {
        $registros = RegistroEstimacion::all();
        return view('registros', ['registros' => $registros]); 
    }

    //mostrar un solo registro
    public function mostrarRegistro($id)
    {
        $registro = RegistroEstimacion::findOrFail($id);
        $estimacion = $registro->estimacion;
        //Volvemos a calcular las formulas para mostrarlas en la vista
        

        $estimacion['formula_esfuerzo_nominal'] = $this->mostrarFormulaEsfuerzoNominal($this->obtenerCoeficientesDelModoBasico($estimacion['modo_de_desarrollo'])['a'], $this->obtenerCoeficientesDelModoBasico($estimacion['modo_de_desarrollo'])['b'], $estimacion['KLOC']);
        $estimacion['formula_esfuerzo_ajustado'] = $this->mostrarFormulaEsfuerzoAjustado($estimacion['esfuerzo_nominal'], $estimacion['EAF']);
        $estimacion['formula_cronograma'] = $this->mostrarFormulaCronograma($this->obtenerCoeficientesDelModoBasico($estimacion['modo_de_desarrollo'])['c'], $this->obtenerCoeficientesDelModoBasico($estimacion['modo_de_desarrollo'])['d'], $estimacion['esfuerzo_ajustado']);
        $estimacion['formula_numero_de_personas'] = $this->mostrarFormulaNumeroDePersonas($estimacion['esfuerzo_ajustado'], $estimacion['cronograma']);
        $estimacion['formula_tiempo_real'] = $this->mostrarFormulaTiempoRealDesarrollo($estimacion['cronograma'], $estimacion['numero_de_personas']);
        $estimacion['formula_costo_total'] = $this->mostrarFormulaCostoTotal($estimacion['esfuerzo_ajustado'], $estimacion['sueldo_por_persona']);
        //Actualizamos el registro con las nuevas formulas
        $registro->estimacion = $estimacion;
        $registro->save();

        if($estimacion['nivel_de_desarrollo'] == "Básico"){
            return view('calculo_nivel_basico', $estimacion);
        }
        else {
            return view('calculo_nivel_intermedio', $estimacion);

        }
    }

    public function eliminarRegistro($id)
    {
        $registro = RegistroEstimacion::findOrFail($id);
        $registro->delete();
        return redirect()->route('registros')->with('success', 'Registro eliminado correctamente.');
    }
}
