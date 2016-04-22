<html>
    <head>
        <style type="text/css">
            @media print {
            .non-printable, .fancybox-outer { display: none; }
            .printable, #print_solicitud { 
                display: block; 
                font-size: 12pt;
                            }}
        </style>
    </head>
</html>
<?php

echo Open('div', array('class' => 'col-md-12', 'style' => 'background:#4187B0'));
echo tagcontent('button', '<span class="glyphicon glyphicon-print"></span> Imprimir', array('id' => 'printbtn', 'data-target' => 'print_solicitud', 'class' => 'btn btn-default pull-left'));
echo Close('div');

echo open("div", array('id' => 'print_solicitud','style'=>'margin-left:40px; margin-right:40px'));
//encabezado
echo open("div", array('align:center'));
$this->load->view('common/hmc_head/encabezado_cuenca');
echo Close('div');
$this->load->view('head');

//tercera fila 
echo LineBreak(2);
$sala = "";
$cama = "";
if($sala_cama){
    $sala =$sala_cama->si_sala;
    $cama = $sala_cama->si_cama;
}
echo '<table class="solicitud_print" style="font-size:9px" cellspacing="0" cellpadding="0" border = "1"  bordercolor = "#000" width="100%">';
echo '<tr class="second_row">';
    echo '<td style="width:20%;text-align:center" ><b> </b></td>';
    echo '<td style="width:20%;text-align:center" ><b></b></td>';
    echo '<td style="width:10%;text-align:center" ><b>SERVICIO</b></td>';
    echo '<td style="width:10%;text-align:center" ><b>SALA</b></td>';
    echo '<td style="width:10%;text-align:center" ><b>CAMA</b></td>';
    echo '<td style="width:12% COLSPAN=2;text-align:center"><b>FECHA DE TOMA</b></td>';
echo '</tr>';
//PRIORIDAD

echo '<tr class="second_row">';
    echo '<td id="" style="text-align:center"></td>';
    echo '<td id="" style="text-align:center"></td>';
    echo '<td id="" style="text-align:center">' . $solicitud[0]->servicio . '</td>';
    echo '<td id="" style="text-align:center">'.$sala.'</td>';
    echo '<td id="" style="text-align:center">'.$cama.'</td>';
    echo '<td id="" style="text-align:center">' . $solicitud[0]->fecha_atencion . '</td>';
echo '</tr>';
echo '</table>';
echo LineBreak(2);
//
echo '<table width="100%" text-align="right" border="1" cellspacing="0" cellpadding="0" style="font-size:10px">';
echo '<tr>';
    echo '<td class="examen_title" style="font-size:10pt"><b> 1 ESTUDIO SOLICITADO</b></td>';
echo '</tr>';
echo '<tr>';
    echo '<td>' . $solicitud[0]->estudio_solicitado . '</td>';
echo '</tr>';
echo '</table border="1">';
echo LineBreak(2);
//
echo '<table width="100%" text-align="right" border="1" cellspacing="0" cellpadding="0" style="font-size:10px">';
echo '<tr>';
echo '<td class="examen_title" style="font-size:10pt"><b> 2.MOTIVO SOLICITADO</b></td>';
echo '</tr>';
echo '<tr>';
echo '<td>' . $solicitud[0]->motivo_solicitud . '</td>';
echo '</tr>';
echo '</table border="1">';


