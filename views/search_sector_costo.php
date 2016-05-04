<?php
echo tagcontent("H1", 'REPORTE CENTRO DE COSTOS Y PISCINAS', array('class' => 'col-md-12'));
echo Open('div', array('name' => 'Datos-form-paciente', 'id' => 'Datos-form-paciente'));
echo Open('form', array('method' => 'post', 'action' => base_url('produccion/consolidado/get_reporte_sector_costo'), 'style' => 'margin-top:10px', 'class' => 'col-md-12', 'id' => 'form_datos_entrada_form_103'));

$combo_bodega = combobox($listsectorbodega, array('label' => 'sec_nombre', 'value' => 'sec_id'), array('class' => 'form-control', 'name' => 'sector', 'id' => 'sector', 'class' => 'custom-select'), true);
echo get_combo_group('Sector', $combo_bodega, 'col-md-4 form-group');
$combo_centrocosto = combobox($listcentrocosto, array('label' => 'nombre', 'value' => 'id'), array('class' => 'form-control', 'name' => 'centro_costo', 'id' => 'centro_costo', 'class' => 'custom-select'), true);
echo get_combo_group('Centro costo', $combo_centrocosto, 'col-md-4 form-group');
echo lineBreak2(1, array('class' => 'clr'));
?>
<div class="col-md-4 form-group">
    <div class="input-group has-success">
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span> 
            Fechas de pesca: 
        </span>
        <input name="fechaIn" id="fechaIn" data-provide="datepicker" class="form-control input-sm" placeholder="Desde" style="width: 50%" required="">
        <input name="fechaFin" id="fechaFin" data-provide="datepicker" class="form-control input-sm" placeholder="Hasta" style="width: 50%" required="">
    </div>
</div>
<?php

echo Open('div', array('class' => 'input-group col-md-3'));
$searchbtn = tagcontent('button', 'Buscar <span class="glyphicon glyphicon-search"></span>'
        , array('type' => 'submit', 'id' => 'ajaxformbtn', 'name' => 'btn_set_produccion', 'data-target' => 'produccion_out', 'class' => 'btn btn-primary'));
echo tagcontent('span', $searchbtn, array('class' => 'input-group-btn'));
echo Close('div');
echo Close('form');
?>
<div id="mensaje_out" class="col-md-12 col-xs-12 col-sm-12"></div>
<div id="produccion_out" class="col-md-12 col-xs-12 col-sm-12"></div>

<script>
    $(function () {
        $(".custom-select").customselect();
    });
</script>