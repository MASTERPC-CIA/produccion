<?php

echo Open('form', array('method' => 'post', 'action' => base_url('produccion/consolidado/save_produccion'), 'class' => 'form-vertical', 'role' => 'form'));
//echo Open('form', array('method' => 'post', 'action' => ), 'id' => 'certificado_medico'));
echo open("div", array('id' => 'form_view', 'name' => 'form_view', 'class' => 'panel panel-success'));
echo open("div", array('class' => 'panel-heading'));
echo "<center><h3>CONSOLIDADO - PESCA MENSUAL</h3></center><br>  ";
echo close('div');
echo open("div", array('class' => 'panel-body'));
echo input(array('type' => 'hidden', 'name' => 'id_paciente', 'id' => 'id_paciente', 'value' => ''));

$combo_centrocosto = combobox(
        $listcentrocosto, array('label' => 'nombre', 'value' => 'id'), array('class' => 'form-control', 'name' => 'centro_costo', 'id' => 'centro_costo'), false);
echo get_combo_group('Centro costo', $combo_centrocosto, 'col-md-4 form-group');
$combo_bodega = combobox(
        $listbodega, array('label' => 'nombre', 'value' => 'id'), array('class' => 'form-control', 'name' => 'bodega', 'id' => 'bodega'), false);
echo get_combo_group('Piscina', $combo_bodega, 'col-md-4 form-group');
$hectareas[] = (array('name' => 'hectareas', 'id' => 'hectareas', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Hectareas', $hectareas, 'col-md-2 form-group');
$a_sembr[] = (array('name' => 'a_sembr', 'id' => 'a_sembr', 'class' => 'form-control', 'value' => ''));
echo get_field_group('A sembr', $a_sembr, 'col-md-2 form-group');

$fecha_siembra[] = (array('name' => 'fecha_siembra', 'id' => 'fecha_siembra', 'class' => 'form-control datepicker', 'value' => '', 'required' => 'required'));
echo get_field_group('Fecha siembra ', $fecha_siembra, 'col-md-3 form-group');
$fecha_pesca[] = (array('name' => 'fecha_pesca', 'id' => 'fecha_pesca', 'class' => 'form-control datepicker', 'value' => '', 'required' => 'required'));
echo get_field_group('Fecha pesca ', $fecha_pesca, 'col-md-3 form-group');
$tipo_siembra[] = (array('name' => 'tipo_siembra', 'id' => 'tipo_siembra', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Tipo siembra', $tipo_siembra, 'col-md-3 form-group');
$lbs_pescadas[] = (array('name' => 'lbs_pescadas', 'id' => 'lbs_pescadas', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Libras pescadas', $lbs_pescadas, 'col-md-3 form-group');

$kilos_consumidos[] = (array('name' => 'kilos_consumidos', 'id' => 'kilos_consumidos', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Kilos_consumidos', $kilos_consumidos, 'col-md-3 form-group');
$larvas_pescadas[] = (array('name' => 'larvas_pescadas', 'id' => 'larvas_pescadas', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Larvas pescadas', $larvas_pescadas, 'col-md-3 form-group');
$costo_larva[] = (array('name' => 'costo_larva', 'id' => 'costo_larva', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Costo larva', $costo_larva, 'col-md-3 form-group');
$costo_mdo_di[] = (array('name' => 'costo_mdo_di', 'id' => 'costo_mdo_di', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Costo mdo d-i', $costo_mdo_di, 'col-md-3 form-group');
$arriendo[] = (array('name' => 'arriendo', 'id' => 'arriendo', 'class' => 'form-control', 'value' => ''));
echo get_field_group('Arriendo', $arriendo, 'col-md-3 form-group');

LineBreak(1, array('class' => 'clr'));
echo Open("div", array('class' => 'form-group'));
echo tagcontent('button', '<span class="glyphicon glyphicon-search"></span> Guardar', array('name' => 'btnreportes', 'class' => 'btn btn-primary  col-md-4', 'id' => 'ajaxformbtn', 'type' => 'submit', 'data-target' => 'print'));
echo close("form");

echo close("div");
echo close("div");
echo close("div");
?>