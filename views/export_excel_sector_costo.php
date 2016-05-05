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
echo '<h4 align="center">CONSOLIDADO DE COSTOS PARA CAMARONERA GONZALES</h4>';
           
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', '<p>COSTOS DIRECTOS</p>');
echo Close('tr');
echo Close('thead');
echo Open('tbody');
$suma_dir=0;
for ($i = 0; $i < count($directos); $i++) {
    echo Open('tr');
    //echo $directos[$i][0];
    $var = 'fcd' . $i;
    $valor = $data_direc[$i][0]->$var;
    echo tagcontent('th', '' . $directos[$i][0] . '');
    if (!empty($valor)) {
        echo tagcontent('th', '' . number_format($data_direc[$i][0]->$var, 2, ',', ' ') . '');
        $suma_dir = $suma_dir + $data_direc[$i][0]->$var;
    } else {
        echo tagcontent('th', '0');
    }
    echo Close('tr');
}
echo Open('tr');
echo tagcontent('th', '<var>Total costos directos</var>');
echo tagcontent('th', $suma_dir);
echo Close('tr');
echo Close('tbody');
echo Close('table');

echo lineBreak2(1);

echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'style' => 'page-break-before:always !important;', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th COLSPAN="2"', '<p>COSTOS INDIRECTOS</p>');
echo Close('tr');
echo Close('thead');
echo Open('tbody');$suma_indir=0;
for ($i = 0; $i < count($indirectos); $i++) {
    echo Open('tr');
    //echo $directos[$i][0];
    $var = 'fcd' . $i;
    $valor = $data_indir[$i][0]->$var;
    echo tagcontent('th', '' . $indirectos[$i][0] . '');
    if (!empty($valor)) {
        echo tagcontent('th', '' . number_format($data_indir[$i][0]->$var, 2, ',', ' ') . '');
        $suma_indir = $suma_indir + $data_indir[$i][0]->$var;
    } else {
        echo tagcontent('th', '0');
    }
    echo Close('tr');
}
echo Open('tr');
echo tagcontent('th', '<var>Total costos indirectos</var>');
echo tagcontent('th', $suma_indir);
echo Close('tr');
echo Close('tbody');
echo Close('table');

echo lineBreak2(1);
$total = $suma_dir + $suma_indir;
echo Open('table', array('class' => 'table table-striped table-bordered table-hover table-condensed table-responsive', 'id' => "recTable"));
echo Open('thead');
echo Open('tr');
echo tagcontent('th', '<var>Total consolodidado: </var>');
echo tagcontent('th', $total);
echo Close('tr');
echo Close('thead');
echo Close('table');

echo Close('div');




