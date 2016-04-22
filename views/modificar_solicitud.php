<?php
            echo Open('form', array('method' => 'post', 'action' => base_url('fisiatria/fisiatria/actualizar_solicitud'), 'id' => 'certificado_medico'));
            echo input(array('type'=>'hidden', 'name'=>'id_solicitud', 'id'=>'id_solicitud','value'=>$solicitud[0]->id_solicitud));
            echo open("div", array('id' => 'form_view'));
                echo "<center><h3>MODIFICAR SOLICITUD DE FISIATRIA</h3></center><br>  ";
                    $apellidoPaterno_field[] = (array('readonly' => 'readonly', 'name' => 'apellido_paterno', 'id' => 'apellido_paterno', 'class' => 'form-control', 'value' => $primer_apellido));
                    echo get_field_group('Apell. Paterno', $apellidoPaterno_field, 'col-md-3 form-group');
                    $apellidoMaterno_field[] = (array('readonly' => 'readonly', 'name' => 'apellido_materno', 'id' => 'apellido_materno', 'class' => 'form-control', 'value' => $segundo_apellido));
                    echo get_field_group('Apell. Materno', $apellidoMaterno_field, 'col-md-3 form-group');
                    $nombres_field[] = (array('readonly' => 'readonly', 'name' => 'p_nombre', 'id' => 'p_nombre', 'class' => 'form-control', 'value' => $primer_nombre));
                    echo get_field_group('Primer Nombre', $nombres_field, 'col-md-3 form-group');
                    $segund_nombres_field[] = (array('readonly' => 'readonly', 'name' => 's_nombre', 'id' => 's_nombre', 'class' => 'form-control', 'value' => $segundo_nombre));
                    echo get_field_group('Segundo Nombre', $segund_nombres_field, 'col-md-3 form-group');
                    $cedula_field[] = (array('readonly' => 'readonly', 'name' => 'cedula', 'id' => 'cedula', 'class' => 'form-control', 'value' => $solicitud[0]->id_cliente));
                    echo get_field_group('Ced. de Ciudadanía', $cedula_field, 'col-md-3 form-group');
                    $edad_field[] = (array('readonly' => 'readonly', 'name' => 'edad', 'id' => 'edad', 'class' => 'form-control', 'value' => $solicitud[0]->edad));
                    echo get_field_group('Edad', $edad_field, 'col-md-2 form-group');
                    $combo_servicio = combobox(
                        $listtiposerv, array('label' => 'tipo', 'value' => 'id'), array('class' => 'form-control', 'name' => 'id_servicio', 'id' => 'id_servicio'), false,$solicitud[0]->id_servicio);
                    echo get_combo_group('Servicio', $combo_servicio, 'col-md-6 form-group');
                    $hClinica_field[] = (array(
                        'name' => 'h_clinica',
                        'id' => 'h_clinica',
                        'class' => 'form-control',
                        'callback' => 'load_cliente',
                        'data-url' => base_url('common/autosuggest/get_client_by_name_hmc/%QUERY'),
                        'value'=>$solicitud[0]->id_cliente));

                    echo get_field_group('No.de la Historia Clinica', $hClinica_field, 'col-md-4 form-group');

                    $fecha_atencion_field[] = (array('name' => 'fecha_atencion', 'id' => 'fecha_atencion', 'class' => 'form-control datepicker', 'value' => $solicitud[0]->fecha_atencion));
                    echo get_field_group('Fecha de atención ', $fecha_atencion_field, 'col-md-3 form-group');
            echo close("div");
            echo open("div", array('class' => 'row col-md-12'))
             ?>
                <ul class="nav nav-tabs">
                    <li><a href="#estudio_solicitado_tex" data-toggle = "tab">ESTUDIO SOLICITADO</a></li>
                    <li><a href="#motivo_solicitud_tex"  data-toggle = "tab">MOTIVO DE LA SOLICITUD</a></li>

                </ul>
            <?php
                echo open("div", array('id' => 'myTabContent', 'class' => 'tab-content col-md-12'));
                
                    echo open("div", array('class' => 'tab-pane ', 'id' => 'estudio_solicitado_tex'));
                        echo tagcontent("textarea", $solicitud[0]->estudio_solicitado, array('class' => 'form-control', 'name' => 'estudio_solicitado', 'id' => 'estudio_solicitado', 'cols' => '30', 'rows' => '5'));
                    echo close("div");

                    echo open("div", array('class' => 'tab-pane fade in active', 'id' => 'motivo_solicitud_tex'));
                        echo tagcontent("textarea",  $solicitud[0]->motivo_solicitud, array('class' => 'form-control', 'name' => 'motivo_solicitud', 'id' => 'motivo_solicitud', 'cols' => '30', 'rows' => '5'));
                    echo close("div");
                echo close("div");

               

?>
