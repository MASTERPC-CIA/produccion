<?php
echo LineBreak(2);
echo warning_msg(' Est&aacute; a punto de anular');
echo Open('form', array('action' => base_url('fisiatria/'.$formulario), 'method' => 'post'));
    echo input(array('type' => 'hidden', 'value' => $id_formulario, 'name' => 'id_postegreso'));
    //echo $planilla_id;
    echo tagcontent('textarea', '', array('name'=>'observaciones','class'=>'form-control','maxlength'=>'500','placeholder'=>'Detalle de la Anulaci&oacute;n'));
    echo LineBreak(2);
    echo tagcontent('button', '<span class="glyphicon glyphicon-trash"></span> Confirmar Anulacion', array('title' => 'Anular Planilla', 'name' => 'btnreportes', 'class' => 'btn btn-danger pull-left  btn-sm', 'id' => 'ajaxformbtn', 'type' => 'submit', 'data-target' => 'anulacion_planilla_det'));
    echo lineBreak2(1, array('style'=>'clear:both'));    
echo Close('form');
echo tagcontent('div', '', array('id' => 'anulacion_planilla_det'));