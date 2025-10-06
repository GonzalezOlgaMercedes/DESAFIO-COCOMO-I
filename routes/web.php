<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ejemplo-modo-organico-nivel-basico', 
function () {
    //información inicial
    $nivel_de_desarrollo = "Básico";
    $modo_de_desarrollo = "Orgánico";
    $KLOC_tamanio_del_software = 40; //expresado en miles de líneas de código
    $EAF_factor_de_ajuste = 1;//en la estimación básica o burda EAF = 1
    

    //Determinar cuánto valen los coeficientes a, b, c y d para el modo orgánico
    if($modo_de_desarrollo == "Orgánico"){
        //coeficientes a y b para el modo orgánico
        $a = 2.4;
        $b = 1.05;
        //coeficientes c y d para el modo orgánico
        $c = 2.5;
        $d = 0.38;
    }

    //¿Cuál es el esfuerzo (PM)? expresado en persona-meses
    //ecuación para clacular el esfuerzo en el nivel Básico: PM = a * (KLOC)^b * EAF
    $PM_esfuerzo = $a * pow($KLOC_tamanio_del_software, $b) * $EAF_factor_de_ajuste;
    $PM_redondeado = ceil($PM_esfuerzo);//redondeamos el valor de PM hacia arriba

    echo "<br>En el nivel {$nivel_de_desarrollo}: El esfuerzo (PM) para un proyecto {$modo_de_desarrollo} es de {$PM_esfuerzo} (&asymp; {$PM_redondeado}), por persona-meses para un sistema de {$KLOC_tamanio_del_software}KLOC.";

    //¿Cuál es su duración (TDEV)?
    //ecuación para calcular la duración (cronograma) del proyecto en el nivel Básico: TDEV = c * (PM)^d * EAF
    $TDEV_duracion_del_proyecto = $c * pow($PM_esfuerzo, $d) * $EAF_factor_de_ajuste;
    $TDEV_redondeado = ceil($TDEV_duracion_del_proyecto);

    echo "<br>En el nivel {$nivel_de_desarrollo}: La duración del proyecto (TDEV), para un proyecto {$modo_de_desarrollo} es de {$TDEV_duracion_del_proyecto} (&asymp; {$TDEV_redondeado}), por persona-meses para un sistema de {$KLOC_tamanio_del_software}KLOC.";
    echo "<br>Por lo que la duración del proyecto es de &asymp; {$TDEV_redondeado} meses aproximadamente para una sola persona trabajando full stack.";

    //¿Cuál es el tamaño del equipo (P)?
    //ecuación para calcular el tamaño del equipo del proyecto en el nivel Básico: P = PM / TDEV
    $P_tamanio_del_equipo = $PM_esfuerzo / $TDEV_duracion_del_proyecto;
    $P_redondeado = ceil($P_tamanio_del_equipo);

    //Calculamos además ¿Cuánto tiempo llevará desarrollar el sistema según el tamaño del equipo.
    $tiempo_real = $TDEV_duracion_del_proyecto / $P_tamanio_del_equipo;
    $tiempo_real_redondeado = ceil($tiempo_real);

    echo "<br>En el nivel {$nivel_de_desarrollo}: Se calcula que el tamño del equipo será de {$P_tamanio_del_equipo} (&asymp; {$P_redondeado}) personas en total, para un proyecto {$modo_de_desarrollo}, cuyo tamaño del software es de {$KLOC_tamanio_del_software}KLOC.";

    echo "<br>Por lo que el tiempo real que llevará desarrollar el sistema con un equipo de {$P_redondeado} personas es de (&asymp; {$tiempo_real_redondeado}) meses aproximadamente.";
});
