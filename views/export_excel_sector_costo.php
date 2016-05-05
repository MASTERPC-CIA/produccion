<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" /><!--Exportar con tildes-->
<?php
header('Content-Type: application/vnd.ms-excel'); // Para trabajar con los navegadores IE y Opera 
header('Content-type: application/x-msexcel'); // Para trabajar con el resto de navegadores
header('Content-Disposition: attachment; filename="reporte_Sector_CentroCosto.xls"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header("Content-Type: charset=utf-8");

echo Open('div', array('id' => 'print_censo_diario', 'class' => 'col-md-12', 'style' => 'padding-left:50px;padding-top:50px;'));
//Cabecera             
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', 'DIRECTOS');
echo Close('tr');
echo Close('thead');
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
echo Close('table');

echo lineBreak2(2);

echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'style' => 'page-break-before:always !important;', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', 'INDIRECTOS');
echo Close('tr');
echo Close('thead');
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
echo Close('table');

echo Close('div');




