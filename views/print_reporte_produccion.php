<?php
// se tratar de abrir un div en esta vista y cerrarlo en otra no se si haya como 
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'bloque_print', 'class' => 'btn btn-default'));
/* METODO PARA EXPORTA A EXCEL */
echo tagcontent('a', '<span class="glyphicon glyphicon-export"></span> Exportar a Excel', array('href' => base_url('estadistica/reporte_102/export_to_excel/' . $fecha_ini . '/' . $fecha_fin), 'method' => 'post', 'target' => '_blank', 'class' => 'btn btn-success btn-sm'));

/* FIN METODO EXPOR A EXCEL */
echo Open('div', array('class' => 'col-md-12', 'id' => 'bloque_print', 'style' => 'font-size:16px;font-family:monospace'));

//Cabecera
function dias_transcurridos($fecha_i, $fecha_f) {
    $dias = (strtotime($fecha_i) - strtotime($fecha_f)) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);
    return $dias;
}

for ($i = 0; $i < count($data); $i++) {
    $grupos_id[$i] = $data[$i]->id_centro_costo;
    $grupos_nombre[$i] = $data[$i]->nombreCentroCosto;
}
$lista_centros_costo = array_values(array_unique($grupos_id));
$lista_centros_nombre = array_values(array_unique($grupos_nombre));
$conta = 0;
//print_r($data);
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
    foreach ($data as $aux) {
        echo Open('tr');
        if ($aux->id_centro_costo == $value1) {
            echo tagcontent('td id="text_data"', $aux->id_piscina); //PISC
            echo tagcontent('td id="text_data"', $aux->hectareas); //# HAS
            echo tagcontent('td id="text_data"', $aux->fecha_siembra); //F.DE SIEMBRA
            $d_cultivo = dias_transcurridos($aux->fecha_siembra, $aux->fecha_pesca);
            echo tagcontent('td id="text_data"', $d_cultivo); //D.CULTIV
            echo tagcontent('td id="text_data"', $aux->fecha_pesca); //F.DE PESCA
            echo tagcontent('td id="text_data"', $aux->a_sembr); //A.SEMBR
            $densidad = $aux->a_sembr / $aux->hectareas;
            echo tagcontent('td id="text_data"', number_format($densidad, 3, ',', ' ')); //DENSIDAD
            echo tagcontent('td id="text_data"', $aux->tipo_siembra); //TIPO/SIEMBRA
            echo tagcontent('td id="text_data"', ''); //gramos %%%%%%%%%%%%%%
            $lbs_balanc = $aux->kilos_consumidos * 2.2046;
            echo tagcontent('td id="text_data"', number_format($lbs_balanc, 3, ',', ' ')); //LBS.BALANC
            echo tagcontent('td id="text_data"', $aux->kilos_consumidos); //kilos consumidos
            echo tagcontent('td id="text_data"', $aux->lbs_pescadas); //LBS. PESCADAS
            $prodXhec = $aux->lbs_pescadas / $aux->hectareas;
            echo tagcontent('td id="text_data"', number_format($prodXhec, 3, ',', ' ')); //PRODUCC X HAS
            echo tagcontent('td id="text_data"', $aux->larvas_pescadas); //# LARVAS PESCADAS
            $sobrev = $aux->larvas_pescadas / $aux->a_sembr;
            echo tagcontent('td id="text_data"', number_format($sobrev, 3, ',', ' ')); //% SOBREV.
            $con_ali = $aux->lbs_pescadas / $lbs_balanc;
            echo tagcontent('td id="text_data"', number_format($con_ali, 3, ',', ' ')); //CONV. ALI-
            echo tagcontent('td id="text_data"', ''); //$ COSTOS MPD  %%%%%%%%%%%%%%% SUELDO RRHH
            echo tagcontent('td id="text_data"', $aux->costo_larva); //$ COSTOS LARVA
            echo tagcontent('td id="text_data"', $aux->costo_mdo_di); //$ COSTO MDO D-I
            echo tagcontent('td id="text_data"', $aux->arriendo); //$ ARRIEND
            echo tagcontent('td id="text_data"', ''); //$ COSTO IND %%%%%%%%%%%%%%
            $total_costo = 0 + $aux->costo_larva + $aux->costo_mdo_di + $aux->arriendo + 0 ;
            echo tagcontent('td id="text_data"', number_format($total_costo, 3, ',', ' ')); //TOTAL COSTO
            $costoXhas = $total_costo/$aux->hectareas;
            echo tagcontent('td id="text_data"', number_format($costoXhas, 3, ',', ' ')); //COST.X.HAS
            $cost_dia=$costoXhas/$d_cultivo;
            echo tagcontent('td id="text_data"', number_format($cost_dia, 3, ',', ' '));//COST.DIA
            echo tagcontent('td id="text_data"', '');//TOTAL VENTA $ %%%%%%%%%%%%%
            echo tagcontent('td id="text_data"', '');//VTA. XHAS   %%%%%%%%%%%%%
            echo tagcontent('td id="text_data"', '');//VTA X LBRA  %%%%%%%%%%%%%
            echo tagcontent('td id="text_data"', '');//VTA X DIA 
            echo tagcontent('td id="text_data"', '');// UTILIDAD X PISCINA  
            echo tagcontent('td id="text_data"', '');// UTILI X HAS  
            echo tagcontent('td id="text_data"', '');//UTILID X DIA 
        }
        echo Close('tr');
    }

    echo Close('thead');
}

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