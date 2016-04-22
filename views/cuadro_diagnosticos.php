<?php
$clinico =""; 
if($cuadro_clinico){
    $clinico =$cuadro_clinico;
    
}
//ESTA VARIABLE ME AYUDA A VER SI ES PARA PRESENTAR O PARA IMPRIMIR  1 PRESENTAR Y 2 IMPRIMIR
if ($opcion == 1) {
    echo Open("div", array('class' => 'form-group'));
    echo input(array('type' => 'hidden', 'id' => 'doc_id', 'name' => 'doc_id', 'value' => $doc_id));
    echo tagcontent("label", "RESUMEN CLINICO: ", array('class' => 'col-md-7 control-label'));
    echo open("div", array('class' => 'col-md-12'));
    echo tagcontent("textarea", $clinico, array('class' => 'form-control', 'name' => 'cuadro_clinico', 'id' => 'cuadro_clinico', 'cols' => '30', 'rows' => '5'));
    echo close("div");
    echo close("div");
    echo LineBreak(2);

    echo Open('div', array('class' => 'block col-md-12'));
    echo Open('table', array('style' => 'width:100%'));
    echo Open('tr', array('class' => 'examen_title'));
    echo tagcontent('td', tagcontent('p', '<strong>DIAGNOSTICOS </strong>'), array('width' => '55%'));
    echo tagcontent('td', '<strong>CIE</strong>', array('width' => '15%'));
    echo tagcontent("td", "<strong>PREF</strong>", array('width' => '15%'));
    echo tagcontent("td", "<strong>DEF</strong>", array('width' => '15%'));
    echo Close('tr');
    if ($diagnostico) {
        foreach ($diagnostico as $item) {
            echo Open('tr');
            echo tagcontent("td", "<input type='hidden' name='diagnostico_items[]' value='" . $item->diag_enfermedad . "'>" . $item->diag_enfermedad);
            echo tagcontent("td", $item->diag_codigo);
            if ($item->id_tipo_diagnostico) {
                if ($item->id_tipo_diagnostico == 1) {
                    echo tagcontent("td", "X");
                    echo tagcontent("td", "");
                } else {
                    echo tagcontent("td", "");
                    echo tagcontent("td", "X");
                }
            } else {
                echo tagcontent("td", "");
                echo tagcontent("td", "");
            }
        }
    }

    echo close('tr');
    echo Close('table');
    echo close("div");

    echo close("div");
} else {
    if ($opcion == 2) {
        ECHO OPEN("DIV");
        echo open("table", array('style' => 'border-collapse:collapse;font-size:10px', 'border' => '1', 'bordercolor' => '#000', 'width' => '100%'));

        /* 3 RESUMEN CLINICO */
        echo Open('tr');
        echo Open('td', array('style' => 'width: 50%;', 'class' => 'subtabla'));
        echo '<table width="100%" text-align="right" border="1" cellspacing="0" cellpadding="0" style="">';
        echo '<tr>';
        echo '<td class="examen_title" style="font-size:10pt"><b> 3. RESUMEN CLINICO</b></td>';
        echo '</tr>';
        echo '<tr>';
        echo tagcontent('td', tagcontent('span', $clinico, array('id' => 'td_resumen_clinico', 'style' => 'width: 100%;')));
        echo '</tr>';
        echo '</table border="1">';
        echo Close('td');

        /* 4 DIAGNOSTICOS */
        echo Open('td', array('style' => 'width: 50%;'));
//            $this->load->view('imagenologia_solicitud_sec4');
        echo '<table width="100%" text-align="right" border="1" cellspacing="0" cellpadding="0" style="border-bottom-style: none;">';
        echo '<tr style="">';
        echo '<td class="examen_title" style="font-size:10pt; border-bottom-style: none;"><strong> 4. DIAGNOSTICOS </strong></td>';
        echo '</tr>';
        echo '</table border="1">';

//            echo '<div id="diagnosticos_table">';
//            echo '</div>';
        echo '<table width="100%" text-align="right" border="1" cellspacing="0" cellpadding="0" style="">';
        echo '<tbody  id="diagnosticos_table" >';
        echo '<tr class="second_row">';
        echo '<td id="print_resumen_clinico">N.</td>';
        echo '<td align="center" id="print_resumen_clinico">CIE=CLASIFICACION INTERNACIONAL DE ENFERMEDADES<BR>PRE:PRESUNTIVO  DEF:DEFINITIVO</th>';
        echo '<td id="print_resumen_clinico">CIE</td>';
        echo '<td id="print_resumen_clinico">PRE. </td>';
        echo '<td id="print_resumen_clinico">DEF. </td>';
        echo '</tr>';
        $i = 1;
        foreach ($diagnostico as $item) {
            echo Open('tr');
            echo tagcontent('td style="background:#b3ffb3;"', $i);
            echo tagcontent('td', $item->diag_enfermedad, array('id' => 'diag_nombre' . $i));
            echo tagcontent('td', $item->diag_codigo, array('id' => 'diag_codigo' . $i));
            echo input(array('type' => 'hidden', 'name' => 'diag_tipo', 'id' => 'diag_tipo' . $i, 'value' => $item->id_tipo_diagnostico)); // envio el ci delpaciente
            if ($item->id_tipo_diagnostico == 1) {
                echo "<td border='1' class='fondo_seleccion'>" . "<p class='seleccionado letra_print_pequenia'>" . "X" . "</p>" . "</td>";
                echo "<td border='1' class='fondo_seleccion'>" . "<p class='no_seleccionado letra_print_pequenia'>" . "" . "</p>" . "</td>";

//                            
            } else {
                echo "<td border='1' class='fondo_seleccion'>" . "<p class='no_seleccionado letra_print_pequenia'>" . "" . "</p>" . "</td>";
                echo "<td border='1' class='fondo_seleccion'>" . "<p class='seleccionado letra_print_pequenia'>" . "X" . "</p>" . "</td>";
//                                
            }
            echo Close('tr');
            $i++;
        }




        echo '</tbody>';

        echo '</table>';
        echo Close('td');
        echo Close('tr');
        echo Close('table');
        ECHO CLOSE("DIV");
    } else {

        echo Open("div", array('class' => 'form-group'));
        echo input(array('type' => 'hidden', 'id' => 'doc_id', 'name' => 'doc_id', 'value' => $doc_id));
        echo tagcontent("label", "RESUMEN CLINICO: ", array('class' => 'col-md-7 control-label'));
        echo open("div", array('class' => 'col-md-12'));
        echo tagcontent("textarea", $clinico, array('class' => 'form-control', 'name' => 'cuadro_clinico', 'id' => 'cuadro_clinico', 'cols' => '30', 'rows' => '5'));
        echo close("div");
        echo close("div");
        echo LineBreak(2);

        echo Open('div', array('class' => 'block col-md-12'));
        echo Open('table', array('style' => 'width:100%'));
        echo Open('tr', array('class' => 'examen_title'));
        echo tagcontent('td', tagcontent('p', '<strong>DIAGNOSTICOS </strong>'), array('width' => '55%'));
        echo tagcontent('td', '<strong>CIE</strong>', array('width' => '15%'));
        echo tagcontent("td", "<strong>PREF</strong>", array('width' => '15%'));
        echo tagcontent("td", "<strong>DEF</strong>", array('width' => '15%'));
        echo Close('tr');
        foreach ($diagnostico as $item) {
            echo Open('tr');
            echo tagcontent("td", $item->diag_enfermedad);
            echo tagcontent("td", $item->diag_codigo);
            if ($item->id_tipo_diagnostico) {
                if ($item->id_tipo_diagnostico == 1) {
                    echo tagcontent("td", "X");
                    echo tagcontent("td", "");
                } else {
                    echo tagcontent("td", "");
                    echo tagcontent("td", "X");
                }
            } else {
                echo tagcontent("td", "");
                echo tagcontent("td", "");
            }
        }
        echo close('tr');
        echo Close('table');
        echo close("div");

        echo Open("div", array('class' => 'form-group'));
        echo tagcontent('button', '<span class="glyphicon glyphicon-search"></span> Guardar', array('name' => 'btnreportes', 'class' => 'btn btn-primary  col-md-12', 'id' => 'ajaxformbtn', 'type' => 'submit', 'data-target' => 'print'));
        echo close("div");

        echo tagcontent("div", '', array('id' => 'print', 'name' => 'print'));
        echo close("div");
        echo close("form");
    }
}