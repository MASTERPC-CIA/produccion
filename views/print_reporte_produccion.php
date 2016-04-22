<?php
// se tratar de abrir un div en esta vista y cerrarlo en otra no se si haya como 
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'bloque_print', 'class' => 'btn btn-default'));
/* METODO PARA EXPORTA A EXCEL */
echo tagcontent('a', '<span class="glyphicon glyphicon-export"></span> Exportar a Excel', array('href' => base_url('estadistica/reporte_102/export_to_excel/' . $fecha_ini . '/' . $fecha_fin), 'method' => 'post', 'target' => '_blank', 'class' => 'btn btn-success btn-sm'));

/* FIN METODO EXPOR A EXCEL */
echo Open('div', array('class' => 'col-md-12', 'id' => 'bloque_print', 'style' => 'font-size:16px;font-family:monospace'));
//Cabecera

for ($i = 0; $i < count($data); $i++) {
    $grupos_factura[$i] = $data[$i]->id_centro_costo;
    $grupos_nombre[$i] = $data[$i]->nombreCentroCosto;
}
$lista_centros_costo = array_values(array_unique($grupos_factura));
$lista_centros_nombre = array_values(array_unique($grupos_nombre));
//print_r($lista_centros_costo);
$conta = 0;
foreach ($lista_centros_costo as $value1) {

    echo '<table width="100%" text-align="right" border="0" cellspacing="0" cellpadding="0" style="font-size:7px;">';
    echo '<tr>';
    echo '<td style="font-size:12px;text-align:left" COLSPAN=30><b>RESUMEN DE PESCAS</b></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td style="font-size:12px;text-align:left" COLSPAN=30><b>SECTOR: ' . $lista_centros_nombre[$conta] . ' </b></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td style="font-size:10px;text-align:left" COLSPAN=30><b>ELABORACION :' . date('Y-m-d') . '</b></td>';
    echo '</tr>';
    echo '</table>';
    /* BLOQUE A */
    echo Open('div', array('class' => 'col-md-12'));
    echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
    echo Open('thead');
    echo Open('tr');
    echo tagcontent('th COLSPAN="30"', 'PRODUCCION</p>');
    echo Close('tr');
    echo Close('thead');

    echo Open('thead');
    echo Open('tr');
    foreach ($datos as $value) {
        echo tagcontent('th id="vertical_centrado"', '<p id="cuadro_3">' . $value . '<p>');
    }
    echo Close('tr');
    echo Close('thead');
    $conta++;


    echo Open('thead');
    foreach ($data as $value) {
        echo Open('tr');
        if ($value->id_centro_costo == $value1) {
            echo tagcontent('td id="text_data"', $value->id_piscina);
        }
        echo Close('tr');
    }

    echo Close('thead');
}





/*
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
/*        $vars = $this->generic_model->get_data('nota_evolucion', array('id_cliente' => $val->id_cliente), 'id', array('id' => 'desc'), 1, null);
  $keylue = '';
  foreach ($vars as $keyue) {
  $keylue = $keyue;
  }
  /* FIN CONS1 */

/*       $salida = $this->generic_model->get_data('nota_evo_diagnostico_alta', array('id_nota' => $keylue));
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
  echo Close('table'); */

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
?>
<style>
    #memo {
        width:10px;
        vertical-align: middle;
        -ms-transform:rotate(270deg); /* IE 9 */
        -moz-transform:rotate(270deg); /* Firefox */
        -webkit-transform:rotate(270deg); /* Safari and Chrome */
        -o-transform:rotate(270deg); /* Opera */
    }
    #memo_14_15_16 {
        width:40px;
        vertical-align: middle;
        -ms-transform:rotate(270deg); /* IE 9 */
        -moz-transform:rotate(270deg); /* Firefox */
        -webkit-transform:rotate(270deg); /* Safari and Chrome */
        -o-transform:rotate(270deg); /* Opera */
    }
    #parrafo_sup_A {
        font-size:10px;
        vertical-align: middle;
    }
    #parrafo_sup {
        font-size:10px;
        vertical-align: middle;
    }
    #parrafo {
        width: 1500%;
        font-size:9px;
        display: table;
        z-index: 0;
    }
    #cuadro_numeros{
        vertical-align: middle;
        text-align: center;
        font-size:8px;
    }
    #cuadro_2{
        /*vertical-align: middle;*/
        text-align: center;
        width: 150px;
        font-size:10px;
    }
    #cuadro_3{
        /*vertical-align: middle;*/
        text-align: center;
        width: 70px;
        font-size:10px;

    }
    #cuadro_4{
        /*vertical-align: middle;*/
        text-align: center;
        width: 50px;
        font-size:10px;
    }
    #texto_cuadro{
        font-size:10px;
    }
    #superior{
        text-align: center;vertical-align: middle;
        font-size:10px;
    }
    #vertical_centrado{
        vertical-align: middle;
        height: 150px;
    }
    #text_data{
        font-size:8px;
        text-align: center; 
        vertical-align: middle;
    }
    #texto_inferior{
        font-size:8px;
    }
    #cuadro_A{
        vertical-align: middle;
        border: 1px solid rgb(200, 200, 200);
        font-size: 10px;
        display: inline-block;
        width:40px !important;
        height:15px !important;
    }
    .table-bordered>thead>tr>td {
        border-bottom-width: 0px;
        height: 5px;
    }
</style>