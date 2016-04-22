<?php

echo Open('div', array('class' => 'col-md-12', 'style' => 'background:#4187B0'));
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'print_solicitud', 'class' => 'btn btn-default pull-left'));
$check_perm1 = $this->user->check_permission(array('generar_pre_factura'), $this->user->id);
if (($check_perm1/* && $tipo_comprob == '01' */)/* || ($check_perm2 && $tipo_comprob == '57') */) {
    echo Open('form', array('action' => base_url('planillaje/planilla/generate_prefacturaLab/' . $solicitud[0]->id.'/4'), 'method' => 'post'));
    //echo input(array('type' => 'hidden', 'value' => $data[0]->id, 'name' => 'id_emer'));
    echo tagcontent('button', '<span class="glyphicon glyphicon-usd"></span> Generar Pre-Factura', array('title' => 'Generar Pre-Factura', 'name' => 'btnreportes', 'class' => 'btn btn-success pull-left', 'type' => 'submit'));
    echo Close('form');
    //echo tagcontent('button', '<span class="glyphicon glyphicon-usd"></span> ' . 'Generar Pre-Factura', array('action' => base_url('planillaje/planilla/generate_prefacturaLab/' . $data_solicitud->sol_id), 'id' => 'ajaxformbtn', 'data-target' => 'formaspagores_out', 'class' => 'btn btn-primary pull-right'));
}
echo Close('div');
echo open("div", array('id' => 'print_solicitud', 'style' => 'margin-left:40px; margin-right:40px'));
//encabezado
$this->load->view('common/hmc_head/encabezado_cuenca');
$this->load->view('head');
//tercera fila 
$sala = "";
$cama = "";
if (!empty($sala_cama)) {
    $sala = $sala_cama->si_sala;
    $cama = $sala_cama->si_cama;
}
echo LineBreak(2);
echo '<table class="solicitud_print" cellspacing="0" cellpadding="0" border = "1"  bordercolor = "#000" width="100%">';
echo '<tr class="second_row">';
echo '<td style="width:20%;text-align:center" ><b>Tipo cliente</b></td>';
echo '<td style="width:20%;text-align:center" ><b>N° Ficha</b></td>';
echo '<td style="width:10%;text-align:center" ><b>SERVICIO</b></td>';
echo '<td style="width:10%;text-align:center" ><b>SALA</b></td>';
echo '<td style="width:10%;text-align:center" ><b>CAMA</b></td>';
echo '<td style="width:12% COLSPAN=2;text-align:center" ><b>FECHA DE TOMA</b></td>';
echo '</tr>';
//print_r($solicitud);
echo '<tr class="second_row">';
echo '<td id="" style="text-align:center">' . $solicitud[0]->tipo . '</td>';
echo '<td id="" style="text-align:center">' . $solicitud[0]->num_ficha . ' </td>';
echo '<td id="" style="text-align:center">' . $solicitud[0]->servicio . '</td>';
echo '<td id="" style="text-align:center">' . $sala . '</td>';
echo '<td id="" style="text-align:center">' . $cama . '</td>';
echo '<td id="" style="text-align:center">' . $solicitud[0]->fecha_realizada . '</td>';
echo '</tr>';
echo '</table>';

echo LineBreak(2);

echo open("table", array('style' => 'border-collapse:collapse;font-size:10px', 'border' => '1', 'bordercolor' => '#000', 'width' => '100%'));
echo '<tr>';
echo '<td class="examen_title" style="font-size:10pt" colspan=5><b> INFORME </b></td>';
echo '</tr>';
echo '<tr>';
    echo tagcontent("td", "<b>Mes</b>");    
    echo tagcontent("td", "<b>Dia</b>");
    echo tagcontent("td", "<b>Tipo de Terapia</b>");
    echo tagcontent("td", "<b>Subsecuente/Una vez</b>");
    echo tagcontent("td", "<b>Altas</b>");
echo '</tr>';
foreach ($mes as $key ) {
        foreach ($informe as $sub) {
        echo '<tr>';

        if($key->id==$sub->mes){
            echo tagcontent("td", $key->mes); 
            echo tagcontent("td", $sub->dia);  
            echo tagcontent("td", $sub->tipo);  
            if($sub->subsecuente == '1'){
                 echo tagcontent("td", 'subsecuente');  
            }else{
                 if($sub->subsecuente == '2'){
                    echo tagcontent("td", 'Una vez');  
                 }else{
                    if($sub->subsecuente == '0'){
                      echo tagcontent("td", 'vacio');     
                    }
                 }
            }
            if($sub->altas=='1'){
                echo tagcontent("td", 'x');  
            }else{
                echo tagcontent("td", ''); 
            }
           
        }
    
    echo '</tr>';
    }
}
/*foreach ($informe as $sub) {
    echo '<tr>';

    echo tagcontent("td", $sub->mes); 
    echo tagcontent("td", $sub->dia);  
    echo tagcontent("td", $sub->tipo);  
    echo tagcontent("td", $sub->subsecuente);  
    echo tagcontent("td", $sub->altas);  
    
    echo '</tr>';
}*/

//print_r($mes);
/*echo open("td");
$operasoli = array();
$i = 0;
foreach ($informe as $inf) {
    $operasoli[$i] = $inf->tipo_terapia;
    $i++;
}
foreach ($tipos_terapia as $sub) {
    if (in_array($sub->id, $operasoli)) {
        echo '<div><label class="control-label col-xs-3">' . $sub->tipo . '</label>';
        echo '<input type="checkbox" name="tipos_terapias[]" value="' . $sub->id . '" class="col-md-1" checked></div>';
    } else {
        echo '<div><label class="control-label col-xs-3">' . $sub->tipo . '</label>';
        echo '<input type="checkbox" name="tipos_terapias[]" value="' . $sub->id . '" class="col-md-1"></div>';
    }
}
echo close("td");
echo '</tr>';
echo "<tr>";
/*echo open("td");
if ($solicitud[0]->subsecuente == 1) {
    echo '<div><label class="control-label col-xs-3">Subsecuente</label>';
    echo '<input type="checkbox" name="subsecuente" value="1" class="col-md-1" checked></div>';

    echo '<div><label class="control-label col-xs-3">Una vez</label>';
    echo '<input type="checkbox" name="subsecuente" value="2" class="col-md-1" >';
} else {
    echo '<div><label class="control-label col-xs-3">Subsecuente</label>';
    echo '<input type="checkbox" name="subsecuente" value="1" class="col-md-1" ></div>';

    echo '<div><label class="control-label col-xs-3">Una vez</label>';
    echo '<input type="checkbox" name="subsecuente" value="2" class="col-md-1" checked>';
}if ($solicitud[0]->subsecuente == 0) {
    echo '<div><label class="control-label col-xs-3">Subsecuente</label>';
    echo '<input type="checkbox" name="subsecuente" value="1" class="col-md-1" ></div>';

    echo '<div><label class="control-label col-xs-3">Una vez</label>';
    echo '<input type="checkbox" name="subsecuente" value="2" class="col-md-1">';
}
echo close("td");

echo "</tr>";*/
echo close('table');

echo LineBreak(2);
echo open("table", array('style' => 'border-collapse:collapse;font-size:10px', 'border' => '1', 'bordercolor' => '#000', 'width' => '100%'));

echo '<tr>';
echo '<td class="examen_title" style="font-size:10pt" colspan="2"> <b> DIAGNOSTICOS </b></td>';
echo '</tr>';
echo '<tr>';
echo tagcontent("td", '<center><b>Diagnostico</b></center>');
echo tagcontent("td", '<center><b>CIE</b></center>');
echo '</tr>';

foreach ($diagnosticos as $diag) {
    echo open("tr");
    echo tagcontent("td", $diag->diag_enfermedad);
    echo tagcontent("td", $diag->cod_diag);
    echo close("tr");
}
echo close('table');


echo LineBreak(2);
echo open("table", array('style' => 'border-collapse:collapse;font-size:10px', 'border' => '1', 'bordercolor' => '#000', 'width' => '100%'));

echo '<tr>';
echo '<td class="examen_title" style="font-size:10pt"><b>Fecha </b></td>';
echo '<td class="examen_title" style="font-size:10pt"><b>Evolucion </b></td>';
echo '</tr>';
if ($evolucion_terapia) {
    foreach ($evolucion_terapia as $tipo) {
        echo open("tr");
        echo "<td>" . $tipo->fecha . "</td>";
        echo "<td>" . $tipo->evolucion . "</td>";
        echo close("tr");
    }
}
echo close('table');

echo close("div");

