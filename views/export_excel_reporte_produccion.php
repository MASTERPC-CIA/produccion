<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" /><!--Exportar con tildes-->
<?php

header('Content-Type: application/vnd.ms-excel'); // Para trabajar con los navegadores IE y Opera 
header('Content-type: application/x-msexcel'); // Para trabajar con el resto de navegadores
header('Content-Disposition: attachment; filename="reporte_egresos_hospitalarios_102.xls"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header("Content-Type: charset=utf-8");

//Cabecera
echo '<table width="100%" text-align="right" border="0" cellspacing="0" cellpadding="0" style="font-size:7px;">';
echo '<tr>';
echo '<td style="font-size:12px;text-align:left" COLSPAN=39><b>DIRECCIÓN DE SANIDAD DE FUERZAS ARMADAS</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td style="font-size:10px;text-align:left" COLSPAN=39><b>SISTEMA COMÚN DE INFORMACIÓN EN SALUD, REGISTRO DE EGRESOS HOSPITALARIOS</b></td>';
echo '</tr>';
echo '</table>';
/* BLOQUE A */
echo Open('div', array('class' => 'col-md-12'));
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="6" ', '');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo_sup">SEXO</span></p>');
echo tagcontent('th', '');
echo tagcontent('th COLSPAN="2" id="superior"', '<span id="parrafo_sup">EDAD AL INGRESO</span>');
echo tagcontent('th COLSPAN="3" id="superior"', '<span id="parrafo_sup">CÁLCULO AUTOMATICO DE LA EDAD</span>');
echo tagcontent('th COLSPAN="3"', '');
echo tagcontent('th COLSPAN="2" id="superior"', '<span id="parrafo_sup">FF.AA.</span>');
echo tagcontent('th', '');
echo tagcontent('th COLSPAN="4" id="superior"', '<span id="parrafo_sup">LUGAR DE RESIDENCIA HABITUAL</span>');
echo tagcontent('th COLSPAN="2" id="superior"', '<span id="parrafo_sup">FECHA<br>(AAAA-MM-DD)</span>');
echo tagcontent('th COLSPAN="3" id="superior"', '<span id="parrafo_sup">EGRESOS</span>');
echo tagcontent('th COLSPAN="7" id="superior"', '<span id="parrafo_sup">DIAGNÓSTICO DE INGRESOS Y EGRESO</span>');
echo tagcontent('th COLSPAN="4" id="superior"', '<span id="parrafo_sup">REFERENCIA, DERIVACIÓN, CONTRAREFERENCIA Y REFERENCIA INVERSA</span>');
echo Close('tr');
echo Close('thead');

echo Open('thead');
echo Open('tr');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">CÓDIGO DE LA UNIDAD DE SALUD<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">FECHA<p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Orden</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">No. de Historia Clinica</span><p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_2">APELLIDOS Y NOMBRES<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">No. de Cédula de Ciudadanía o No. de pasapaorte o No. Historia Clinica<p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">1 Hombre; 2 Mujer</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Fecha de Nacimiento <br>(dd/mm/aaaa)</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Edad expresada en: <br> 1 Horas, 2 Dias, 3 meses, <br>4 años</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Edad</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">AÑOS</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">MESES</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">DÍAS</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Nacionalidad</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Indique el País en caso de <br>escoger Nacionalidad, <br>opción 5</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Auto Identificación étnica </span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Fuerza</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Tipo de usuario</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">DISCAPACIDAD PERMANENTE <br>(Al momento del ingreso)</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Provincia</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Cantón</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Parroquia</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Localidad</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Ingreso</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Egreso</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">DÍAS DE ESTADIA</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">CONDICIÓN AL INGRESO</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">ESPECIALIDAD DEL EGRESO</span><p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">DE INGRESO<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">DEFINITIVO DE EGRESO PRINCIPAL<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">1ero. DEFINITIVO SECUNDARIO<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">2do. DEFINITIVO SECUNDARIO<p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">3ero. CAUSA EXTERNA<p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Código CIE-10<br>(Definitivo de Egreso <br>Principal)</span><p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">VERIFICACIÓN DEL DIAGNÓSTICO DEFINITIVO DE EGRESO<p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Enviado con:<br>(Códigos D-3)</span><p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Servicio al que se envía<br>(Códigos D-3)</span><p>');
echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">Nombre de la Unidad de Salud<p>');
echo tagcontent('th', '<p id="memo_14_15_16"><span id="parrafo">Institución del Sistema<br>(Códigos A-3)</span><p>');

echo Close('tr');
echo Close('thead');

echo Open('thead');
echo Open('tr');
echo tagcontent('th id="cuadro_numeros"', '1');
echo tagcontent('th id="cuadro_numeros"', '2');
echo tagcontent('th id="cuadro_numeros"', '3');
echo tagcontent('th id="cuadro_numeros"', '4');
echo tagcontent('th id="cuadro_numeros"', '5');
echo tagcontent('th id="cuadro_numeros"', '6');
echo tagcontent('th id="cuadro_numeros"', '7');
echo tagcontent('th id="cuadro_numeros"', '8');
echo tagcontent('th id="cuadro_numeros" COLSPAN=3', '');
//echo tagcontent('th id="cuadro_numeros"', '9');
//echo tagcontent('th id="cuadro_numeros"', '10');
//echo tagcontent('th id="cuadro_numeros"', '11');
echo tagcontent('th id="cuadro_numeros"', '9');
echo tagcontent('th id="cuadro_numeros"', '10');
echo tagcontent('th id="cuadro_numeros"', '11');
echo tagcontent('th id="cuadro_numeros"', '12');
echo tagcontent('th id="cuadro_numeros"', '13');
echo tagcontent('th id="cuadro_numeros"', '14');
echo tagcontent('th id="cuadro_numeros"', '15');
echo tagcontent('th id="cuadro_numeros"', '16');
echo tagcontent('th id="cuadro_numeros"', '17');
echo tagcontent('th id="cuadro_numeros"', '18');
echo tagcontent('th id="cuadro_numeros"', '19');
echo tagcontent('th id="cuadro_numeros"', '20');
echo tagcontent('th id="cuadro_numeros"', '21');
echo tagcontent('th id="cuadro_numeros"', '22');
echo tagcontent('th id="cuadro_numeros"', '23');
echo tagcontent('th id="cuadro_numeros"', '24');
echo tagcontent('th id="cuadro_numeros"', '25');
echo tagcontent('th id="cuadro_numeros"', '26');
echo tagcontent('th id="cuadro_numeros"', '27');
echo tagcontent('th id="cuadro_numeros"', '28');
echo tagcontent('th id="cuadro_numeros"', '29');
echo tagcontent('th id="cuadro_numeros"', '30');
echo tagcontent('th id="cuadro_numeros"', '31');
echo tagcontent('th id="cuadro_numeros"', '32');
echo tagcontent('th id="cuadro_numeros"', '33');
echo tagcontent('th id="cuadro_numeros"', '34');
echo tagcontent('th id="cuadro_numeros"', '35');
echo tagcontent('th id="cuadro_numeros"', '36');
echo Close('tr');
echo Close('thead');

//print_r($data);
function ExpresadaEdad($fecha) {
    $dia = date("j");
    $mes = date("n");
    $ano = date("Y");
//fecha de nacimiento
    list($dianaz, $mesnaz, $anonaz) = explode("-", $fecha);
    if (($mesnaz == $mes) && ($dianaz > $dia)) {
        $ano = ($ano - 1);
    }
//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
    if ($mesnaz > $mes) {
        $ano = ($ano - 1);
    }
//ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad
    //$edad = ($ano - $anonaz);
    if ($ano > 1) {
        return $expEdad = 4;
    } else {
        return $expEdad = 3;
    }
}

function CalculaEdad($fecha) {
    list($Y, $m, $d) = explode("-", $fecha);
    return( date("md") < $m . $d ? date("Y") - $Y - 1 : date("Y") - $Y );
}

$cont = 1;
$actualidad = new DateTime();
if (!empty($data)) {
    //print_r($data);
    foreach ($data as $val) {
        echo Open('tr');
        //GUIA----> echo tagcontent('td id="text_data"', $va->PersonaComercio_cedulaRuc); //28

        echo tagcontent('td id="text_data"', get_settings('COD_UNIDAD_SALUD'));
        $keywords = preg_split("/[\s-]+/", $val->fecha_registro);
        //list($año, $mes, $día) = preg_split('-', $fecha_ini);
        echo tagcontent('td id="text_data"', $keywords[0] . $keywords[1]); //2016-03-04
        echo tagcontent('td id="text_data"', $cont); //1
        echo tagcontent('td id="text_data"', $val->PersonaComercio_cedulaRuc); //2
        echo tagcontent('td id="text_data"', $val->apellidos . ' ' . $val->nombres); //3
        echo tagcontent('td id="text_data"', $val->representante_legal); //4
        echo tagcontent('td id="text_data"', $val->sexo); //5
        echo tagcontent('td id="text_data"', $val->fecha_nacimiento); //6
        $expEdad = ExpresadaEdad($val->fecha_nacimiento);
        echo tagcontent('td id="text_data"', $expEdad); //7
        $edad = CalculaEdad($val->fecha_nacimiento);
        echo tagcontent('td id="text_data"', $edad); //8
        $fechaInicial = new DateTime($val->fecha_nacimiento);
        $interval = $fechaInicial->diff($actualidad);
        echo tagcontent('td id="text_data"', $interval->format('%y')); //
        echo tagcontent('td id="text_data"', $interval->format('%m')); //
        echo tagcontent('td id="text_data"', $interval->format('%d')); // 
        if ($val->nacionalidad_id > 0) {
            echo tagcontent('td id="text_data"', $val->nacionalidad_id); //9
        } else {
            echo tagcontent('td id="text_data"', ''); //9
        }
        echo tagcontent('td id="text_data"', ''); //10
        if ($val->etnia_id > 0) {
            echo tagcontent('td id="text_data"', $val->etnia_id); //11
        } else {
            echo tagcontent('td id="text_data"', ''); //11
        }
        if ($val->fuerza_id > 0) {
            echo tagcontent('td id="text_data"', $val->fuerza_id); //12
        } else {
            echo tagcontent('td id="text_data"', ''); //12
        }
        if ($val->clientetipo_idclientetipo > 0) {
            echo tagcontent('td id="text_data"', $val->clientetipo_idclientetipo); //13
        } else {
            echo tagcontent('td id="text_data"', ''); //13
        }
        if ($val->discapacidad_id > 0) {
            echo tagcontent('td id="text_data"', $val->discapacidad_id); //14
        } else {
            echo tagcontent('td id="text_data"', ''); //14
        }
        echo tagcontent('td id="text_data"', $val->provincia); //17
        echo tagcontent('td id="text_data"', $val->canton); //18
        echo tagcontent('td id="text_data"', $val->parroquia); //19
        echo tagcontent('td id="text_data"', $val->direccion); //20
        echo tagcontent('td id="text_data"', $val->fecha_registro); //21
        echo tagcontent('td id="text_data"', $val->fecha_egreso); //22
        $fechaIn = new DateTime($val->fecha_registro);
        $fechaEg = new DateTime($val->fecha_egreso);
        $inter = $fechaIn->diff($fechaEg);
        echo tagcontent('td id="text_data"', $inter->format('%d')); //23
        echo tagcontent('td id="text_data"', ''); //24-> por agregar
        echo tagcontent('td id="text_data"', $val->id_cargo . '/' . $val->nombreCargo); //25
        echo tagcontent('td id="text_data"', $val->si_diag_provisional); //26



        /* SACA TODOS LOS ULTIMOS DE LA TABLA DE NOTA DE DEVOLUCION----INICIA--->CONS1 */
        $vars = $this->generic_model->get_data('nota_evolucion', array('id_cliente' => $val->id_cliente), 'id', array('id' => 'desc'), 1, null);
        $keylue = '';
        foreach ($vars as $keyue) {
            $keylue = $keyue;
        }
        /* FIN CONS1 */

        $salida = $this->generic_model->get_data('nota_evo_diagnostico_alta', array('id_nota' => $keylue));
        $var = count($salida);
        $not_diag = array_slice($salida, 0, 3);
        $aux_dos = 0;
        if (!empty($salida)) {
            foreach ($not_diag as $key) {
                $tres = $this->generic_model->get('diagnostico', array('diag_codigo' => $key->cod_cie), 'diag_enfermedad, diag_codigo');
                foreach ($tres as $aux) {
                    if ($var == 1) {
                        echo tagcontent('td id="text_data"', $aux->diag_enfermedad); //28
                        $aux_dos = 1;
                        continue;
                    }
                    if ($var == 2) {
                        echo tagcontent('td id="text_data"', $aux->diag_enfermedad); //28
                        $aux_dos = 2;
                        continue;
                    }
                    if ($var > 2) {
                        $aux_dos = 3;
                        echo tagcontent('td id="text_data"', $aux->diag_enfermedad); //28
                        continue;
                    }
                }
            }
        } else {

            echo tagcontent('td id="text_data"', ''); //28
            echo tagcontent('td id="text_data"', ''); //28
            echo tagcontent('td id="text_data"', ''); //28
        }
        if ($aux_dos == 1) {
            echo tagcontent('td id="text_data"', ''); //28
            echo tagcontent('td id="text_data"', ''); //28
            echo tagcontent('td id="text_data"', ''); //28
        }
        if ($aux_dos == 2) {
            echo tagcontent('td id="text_data"', ''); //28
            echo tagcontent('td id="text_data"', ''); //28
        }
        if ($aux_dos == 3) {
            echo tagcontent('td id="text_data"', ''); //28
        }
        if (!empty($not_diag)) {
            echo tagcontent('td id="text_data"', $not_diag[0]->cod_cie); //31
        } else {
            echo tagcontent('td id="text_data"', ''); //31
        }
        echo tagcontent('td id="text_data"', ''); //32
        //Referencia 33
        if ($val->referencia == 1) {
            echo tagcontent('td id="text_data"', '1');
        } else {
            if ($val->derivacion == 1) {
                echo tagcontent('td id="text_data"', '2');
            } else {
                if ($val->contrareferencia == 1) {
                    echo tagcontent('td id="text_data"', '3');
                } else {
                    if ($val->ref_inversa == 1) {
                        echo tagcontent('td id="text_data"', '4');
                    } else {
                        echo tagcontent('td id="text_data"', '');
                    }
                }
            }
        }
        echo tagcontent('td id="text_data"', $val->r_1_servicio_2); //34
        echo tagcontent('td id="text_data"', $val->r_1_establecimiento_2); //35
        echo tagcontent('td id="text_data"', $val->r_1_institucion_sis); //36

        $cont++;
        echo Close('tr');
    }
} else {
    echo '<h3>No existen datos</h3>';
}
echo Close('table');

$primero = '<span id="texto_inferior">** Según la Constitución Ecuatoriana en el Art. 35 etablece las personas y grupos de atencion prioritaria.<br>';
$primero.= '* Este campo será llenado obligatoriamente cuando el paciente atendido sea menor de 5 años.</span>';
$segundo = '<span id="texto_inferior">Según el Art. 21 de la Ley de Estadística que establece: Los datos individuales que se obtengan para efecto de estadística y censos son de carácter reservadoñ en consecuencia, no podran darse a conocer informaciones individuales de ninguna especie, ni podrán ser utilizados para otros fines como de tributación o conscripción, investigaciones judiciales, y en general, para cualquier objeto distinto del propiamente estadístico o censal. Solo se darán a conocer los resúmenes numéricos, las consentraciones globales, las totalizaciones y en general los datos impersonales.</font></span>';

echo '<table width="100%" text-align="right" border="0" cellspacing="0" cellpadding="0" style="font-size:7px;">';
echo '<tr>';
echo '<td style="font-size:12px;text-align:left"><b>DISAFA-SISFA Form.504/2015</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td style="font-size:10px;text-align:left"><b> ' . $primero . ' </b></td>';
echo '</tr>';
echo '<tr>';
echo '<td style="font-size:10px;text-align:left"><b> ' . $segundo . ' </b></td>';
echo '</tr>';
echo '</table>';


echo Close('div');
echo Close('div');
echo Close('div');