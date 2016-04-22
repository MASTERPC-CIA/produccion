<?php
echo Open('div', array('class' => 'col-md-12'));
$caja_texto = '<input type="text" id="search" placeholder="Buscar" class="form-control input-sm">';

echo "<div class='panel panel-success'>";
ECHO '<div class="panel-heading">
          <div class="row">
            <div class="col-md-4">NUMEROS DE REGISTROS ENCONTRADOS : N° ' . $num_registros . '</div>
             <div class="col-md-4 col-md-offset-4">' . $caja_texto . '</div> 
          </div>
        </div>';

echo '<div id="div1">';
echo Open('table', array('id' => 'table', 'class' => "table table-fixed-header"));
echo '<thead>';
$thead = array(
'Nro',
 'CI',
 'Paciente',
 'Fecha Solcitud',
 'Servicio',
 'Motivo');
echo tablethead($thead);
echo '</thead>';
echo '<tbody>';
if (!empty($solicitud)):
    foreach ($solicitud as $val) {
        echo Open('tr');
        echo tagcontent('td', $val->id);
        echo tagcontent('td', $val->id_cliente);
        echo tagcontent('td', $val->nombres);
        echo tagcontent('td', $val->fecha_atencion);
        echo tagcontent('td', $val->servicio);
        echo tagcontent('td', $val->motivo_solicitud);

        echo '<td>';
        ?>

        <button type="button"  title = "Imprimir Solicitud" data-target="opcion_elegida" id="ajaxpanelbtn" class="btn btn-default fa fa-print" data-url="<?php echo base_url('fisiatria/fisiatria/get_imprimir/' . $val->id); ?>"></button>
        <button type="button"  title = "Editar Solicitud" data-target="opcion_elegida" class="btn btn-primary fa fa-edit" id="ajaxpanelbtn" data-url="<?php echo base_url('fisiatria/fisiatria/modificar_solicitud_view/' . $val->id) ?>"></button>
        <button type="button"  title = "Anular Solicitud"   data-target="opcion_elegida" id="ajaxpanelbtn" class="btn btn-danger fa fa-trash-o"  data-url="<?php echo base_url('fisiatria/fisiatria/anular_view/' . $val->id); ?>"></button>
        <?php
        echo '</td>';
        echo Close('tr');
    }
endif;
echo '</tbody>';
echo '</table>';
echo '</div>';

echo "</div>";
echo Close('div');
?>

<style>

    #div1 {
        overflow:scroll;
        height:400px;
        width:100%;
    }
    #div1 table {
        width:100%;
    }
</style>
<script>

    var $rows = $('#table tr');
    $('#search').keyup(function () {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
</script>