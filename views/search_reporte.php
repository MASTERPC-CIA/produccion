<?php
echo Open('div', array('align' => 'center', 'class' => 'col-md-12', 'id'=>'search_div'));
echo '<h1 class="page-header"><small><font class="text-success">BUSCAR E IMPRIMIR INFORMES DE FISIATRIA</font></small></h1>';
echo Close('div');
echo lineBreak(1);
echo Open('form', array('action' => base_url('fisiatria/informe/listInforme'), 'method' => 'post'));

echo Open('div', array('class' => 'col-md-4 form-group'));
echo Open('div', array('class' => 'input-group has-success'));
echo tagcontent('span', '<span class="glyphicon glyphicon-calendar"></span> Fecha Creacion: ', array('class' => 'input-group-addon'));
echo input(array('name' => "fechaIn", 'id' => "fechaIn", 'data-provide' => "datepicker", 'class' => "form-control input-sm", 'placeholder' => "Desde", 'style' => "width: 50%"));
echo input(array('name' => "fechaFin", 'id' => "fechaFin", 'data-provide' => "datepicker", 'class' => "form-control input-sm", 'placeholder' => "Hasta", 'style' => "width: 50%"));
echo Close('div');
echo Close('div');
echo Open('div', array('class' => 'col-md-3 form-group'));
echo Open('div', array('class' => 'input-group has-success'));
echo tagcontent('span', '<span class="glyphicon glyphicon-check"></span> Estado: ', array('class' => 'input-group-addon'));
?>
<select name ="op_estado" class="combobox form-control input-sm">
    <option value="1">Archivada</option>
    <option value="0">Anulada</option>
</select>
<?php
echo Close('div');
echo Close('div');


$lista_empleado_combo = combobox($lista_empleado, array('label' => 'nom_empleado', 'value' => 'id'), array('name' => 'profesionaldiv', 'id' => 'profesionaldiv', 'class' => 'combobox form-control input-sm'), true);
echo Open('div', array('class' => 'col-md-4 form-group'));
echo Open('div', array('class' => 'input-group has-success'));
echo tagcontent('span', '<span class="glyphicon glyphicon-user"></span>  Especialista:', array('class' => 'input-group-addon'));
echo $lista_empleado_combo;
echo Close('div');
echo Close('div');
echo input(array('type' => 'hidden', 'name' => 'id_paciente', 'id' => 'id_paciente', 'value' => '')); // envio el id delpaciente
echo input(array('type' => 'hidden', 'name' => 'tipo_identificacion', 'id' => 'tipo_identificacion', 'value' => '')); // envio el id delpaciente

echo Open('div', array('class' => 'col-md-4 form-group'));
echo Open('div', array('class' => 'input-group has-success'));
echo tagcontent('span', '<span class="glyphicon glyphicon-user"></span> Paciente: ', array('class' => 'input-group-addon'));
echo input(array('id' => 'ci', 'name' => 'ci', 'class' => 'form-control input-sm typeahead', 'placeholder' => 'Num. identificacion',
    'callback' => 'refresh_cart_load_client', 'data-url' => base_url('common/autosuggest/get_client_by_name/%QUERY'), 'style' => 'position: absolute;'));

echo Close('div');
echo Close('div');
echo tagcontent('button', '<span class="glyphicon glyphicon-search"></span> Buscar', array('name' => 'btnreportes', 'class' => 'btn btn-success btn-sm  col-md-1', 'id' => 'ajaxformbtn', 'type' => 'submit', 'data-target' => 'opcion_elegida'));
echo Close('form');
echo tagcontent('div', '', array('id' => 'opcion_elegida', 'class' => 'col-md-12'));
?>


<script>

    var refresh_cart_load_client = function (datum) {
        var url = main_path + 'emergencia/interconsultas/get_paciente_info/time/' + $.now();
        $('#id_paciente').val(datum.ci);
        $("#id_paciente_turno").val($("#id_paciente").val());//si se bsuqca por nombre toma el valor desde aqui        
    };
    $.autosugest_search('#ci');


</script>
