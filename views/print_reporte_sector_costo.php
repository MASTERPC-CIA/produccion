<?php
// se tratar de abrir un div en esta vista y cerrarlo en otra no se si haya como 
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'bloque_print', 'class' => 'btn btn-default'));
/* METODO PARA EXPORTA A EXCEL */
echo tagcontent('a', '<span class="glyphicon glyphicon-export"></span> Exportar a Excel', array('href' => base_url('produccion/consolidado/export_to_excel_sector_costo/' . $fecha_ini . '/' . $fecha_fin. '/' . $sector. '/' . $centro_costo), 'method' => 'post', 'target' => '_blank', 'class' => 'btn btn-success btn-sm'));
/* FIN METODO EXPOR A EXCEL */
echo Open('div', array('class' => 'col-md-12', 'id' => 'bloque_print', 'style' => 'font-size:12px;font-family:monospace'));

//Cabecera             
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', 'DIRECTOS');
echo Close('tr');echo Close('thead');
echo Open('tbody');
for ($i = 0; $i < count($directos); $i++) {
    echo Open('tr');
    //echo $directos[$i][0];
    $var = 'fcd' . $i;
    $valor = $data_direc[$i][0]->$var;
    echo tagcontent('th', '' . $directos[$i][0] . '');
    if (!empty($valor)) {
        echo tagcontent('th', '' . number_format($data_direc[$i][0]->$var, 2, ',', ' ') . '');
    } else {
        echo tagcontent('th', '0');
    }
    echo Close('tr');
}
echo Close('tbody');

echo lineBreak2(2);
             
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive','style'=>'page-break-before:always !important;','id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', 'INDIRECTOS');
echo Close('tr');echo Close('thead');
echo Open('tbody');
for ($i = 0; $i < count($indirectos); $i++) {
    echo Open('tr');
    //echo $directos[$i][0];
    $var = 'fcd' . $i;
    $valor = $data_indir[$i][0]->$var;
    echo tagcontent('th', '' . $indirectos[$i][0] . '');
    if (!empty($valor)) {
        echo tagcontent('th', '' . number_format($data_indir[$i][0]->$var, 2, ',', ' ') . '');
    } else {
        echo tagcontent('th', '0');
    }
    echo Close('tr');
}
echo Close('tbody');

echo Close('div');
?>