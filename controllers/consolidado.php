<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consolidado extends MX_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('grocery_CRUD');
        $this->user->check_session();
        //$this->load->library('fisiatria/paciente_fisiatria');
        $this->load->library('common/paciente_estadistica');
        $this->load->library('common/paciente_consulta');
    }

    function save_produccion() {
        $datos = array(
            'id_centro_costo' => $this->input->post('centro_costo'),
            'id_piscina' => $this->input->post('bodega'),
            'hectareas' => $this->input->post('hectareas'),
            'fecha_siembra' => $this->input->post('fecha_siembra'),
            'fecha_pesca' => $this->input->post('fecha_pesca'),
            'a_sembr' => $this->input->post('a_sembr'),
            'tipo_siembra' => $this->input->post('tipo_siembra'),
            'lbs_pescadas' => $this->input->post('lbs_pescadas'),
            'larvas_pescadas' => $this->input->post('larvas_pescadas'),
            'costo_larva' => $this->input->post('costo_larva'),
            'costo_mdo_di' => $this->input->post('costo_mdo_di'),
            'arriendo' => $this->input->post('arriendo'),
            'kilos_consumidos' => $this->input->post('kilos_consumidos'),
        );

        $save = $this->generic_model->save($datos, 'produccion');

        if ($save) {
            echo tagcontent('script', 'alertaExito("Se ha guardado correctamente los datos")');
            echo tagcontent('script', "$('form_view').html('<b>Datos ingresados correctamente </b>')");
            //$this->get_nuevaProd($save);
        } else {
            echo warning_msg('No se ha podido la información');
            $this->db->trans_rollback();
            die();
        }
    }

    public function get_nuevaProd($id_solicitud) {
        $datos['listcentrocosto'] = $this->generic_model->get('billing_centroscosto');
        $datos['listbodega'] = $this->generic_model->get('billing_bodega');

        $res['view'] = $this->load->view('view_consolidado', $datos, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        $this->load->view('common/templates/dashboard_lte', $res);
    }

//EN ESTA FUNCION VERIFICAMOS EL DOC ID DEL SERVICIO DE LA TABLA HISTORIAL ESTADOS PACIENTE 
// Y SACAMOS EL CUADRO CLINICO
    public function getcuadro_clinico() {
        $paciente_id = $this->input->post('id_paciente');
        $servicio_id = $this->input->post('id_servicio');

        $this->getcuadro_clinico_view($paciente_id, $servicio_id, 1);
    }

    public function getcuadro_clinico_view($paciente_id, $servicio_id, $opcion) {
        $doc_id = $this->paciente_fisiatria->get_historial($paciente_id, $servicio_id);
        $res = $this->paciente_fisiatria->getcuadro_clinico_diag($servicio_id, $doc_id, $paciente_id, $opcion);
        $this->load->view('cuadro_diagnosticos', $res);
    }

    public function list_solicitudes() {
        $fecha_ini = $this->input->post('fechaIn');
        $fecha_fin = $this->input->post('fechaFin');
        $id_paciente = $this->input->post('id_paciente');
        $servicio = $this->input->post('servicio_consultado');
        $estado = $this->input->post('op_estado');
        $id_doctor = $this->input->post('profesionaldiv');
        if ($id_doctor == '-1'):$id_doctor = '';
        else:$id_profesi = $id_doctor;
        endif;
        if ($servicio == '-1'):$servicio = '';
        else:$ser_consult = $servicio;
        endif;
        $where_data = array('f.estado' => $estado, 'f.aprobada' => '0');

        if (!empty($fecha_ini) and ! empty($fecha_fin)) {
            $where_data = array('f.fecha_atencion >=' => $fecha_ini, 'f.fecha_atencion <=' => $fecha_fin, 'f.estado' => $estado, 'f.aprobada' => '0');
        }
        if (!empty($servicio)) {
            $where_data = array('f.id_servicio' => $ser_consult, 'f.estado' => $estado, 'f.aprobada' => '0');
        }

        if (!empty($id_paciente)) {
            $where_data = array('f.id_cliente' => $id_paciente, 'f.estado' => $estado, 'f.aprobada' => '0');
        }
        if (!empty($id_profesi)) {
            $where_data = array('f.medico_solicitante' => $id_doctor, 'f.estado' => $estado, 'f.aprobada' => '0');
        }
        $datos['solicitud'] = $this->get_solicitud($where_data);
        $datos['num_registros'] = count($datos['solicitud']);
        $this->load->view('list_solicitudes', $datos);
    }

    public function reporte_solicitudes() {
        $datos['listtiposerv'] = $this->generic_model->get('bill_sttiposervicio');
        $datos['lista_empleado'] = $this->generic_model->get_all('billing_empleado', array('CONCAT_WS(" ",nombres," ",apellidos) nom_empleado', 'id, PersonaComercio_cedulaRuc'));

        $res['view'] = $this->load->view('search_solicitudes', $datos, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        $this->load->view('common/templates/dashboard_lte', $res);
    }

    public function get_solicitud($where_data) {
        $fields = 'f.*,c.nombres,c.apellidos,c.edad, c.id as idCliente,f.id as id_solicitud,
            (select tipo from bill_sttiposervicio t where f.id_servicio = t.id) as servicio';
        $join = array(
            '0' => array('table' => 'billing_cliente c', 'condition' => 'c.id=f.id_cliente')
        );
        $datos = $this->generic_model->get_join('hmc_solicitud_fisiatria f', $where_data, $join, $fields);
        return $datos;
    }

    public function modificar_solicitud_view($id_solicitud) {
        $where_data = array('f.id' => $id_solicitud);
        $datos['solicitud'] = $this->get_solicitud($where_data);
        $servicio_id = $datos['solicitud'][0]->id_servicio;
        $paciente_id = $datos['solicitud'][0]->idCliente;
        $datos['primer_nombre'] = $this->paciente_estadistica->get_primer_nombre($datos['solicitud'][0]->nombres);
        $datos['segundo_nombre'] = $this->paciente_estadistica->get_segundo_nombre($datos['solicitud'][0]->nombres);
        $datos['primer_apellido'] = $this->paciente_estadistica->get_primer_apellido($datos['solicitud'][0]->apellidos);
        $datos['segundo_apellido'] = $this->paciente_estadistica->get_segundo_apellido($datos['solicitud'][0]->apellidos);
        $datos['listtiposerv'] = $this->generic_model->get('bill_sttiposervicio');

        $this->load->view('modificar_solicitud', $datos);
        $datos = $this->getcuadro_clinico_view($paciente_id, $servicio_id, 3);
    }

    public function actualizar_solicitud() {
        $id_solicitud = $this->input->post('id_solicitud');
        $datos = array(
            'cuadro_clinico' => $this->input->post('cuadro_clinico'),
            'fecha_atencion' => $this->input->post('fecha_atencion'),
            'estudio_solicitado' => $this->input->post('estudio_solicitado'),
            'motivo_solicitud' => $this->input->post('motivo_solicitud'),
        );
        $update = $this->generic_model->update('hmc_solicitud_fisiatria', $datos, array('id' => $id_solicitud));
        if ($update) {
            echo tagcontent('script', 'alertaExito("Se ha guardado correctamente los datos")');
            echo tagcontent('script', "$('#patient_info_datos_form').html('<b>Datos ingresados correctamente </b>')");

            $this->get_imprimir($id_solicitud);
        } else {
            echo warning_msg('No se ha podido Ingresar el la fisiatria');
            $this->db->trans_rollback();
            die();
        }
    }

    public function anular_view($id_solicitud) {
        if ($id_solicitud > 0) {
            $data['id_formulario'] = $id_solicitud;
            $data['formulario'] = 'fisiatria/anular_solicitud';
            $this->load->view('form_anulacion', $data);
        }
    }

    public function anular_solicitud() {
        $param = $this->input->post('id_postegreso');
        $obs_anula = $this->input->post('observaciones');

        $this->generic_model->update('hmc_solicitud_fisiatria', array('estado' => '0', 'observaciones' => $obs_anula), array('id' => $param));
        echo tagcontent('script', 'alertaExito("Anulada con exito")');
        echo tagcontent('script', "window.location.replace('" . base_url('fisiatria/') . "')");
    }

    public function reporte_sol() {
        $datos['listtiposerv'] = $this->generic_model->get('bill_sttiposervicio');
        $datos['lista_empleado'] = $this->generic_model->get_all('billing_empleado', array('CONCAT_WS(" ",nombres," ",apellidos) nom_empleado', 'id, PersonaComercio_cedulaRuc'));

        $res['view'] = $this->load->view('solicitud_pendientes', $datos, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        $this->load->view('common/templates/dashboard_lte', $res);
    }

//mostramos los reportes de las solicitudes ingresadas y pendientes
    public function list_sol_pendiente() {
        $fecha_ini = $this->input->post('fechaIn');
        $fecha_fin = $this->input->post('fechaFin');
        $id_paciente = $this->input->post('id_paciente');
        $servicio = $this->input->post('servicio_consultado');
        $estado = $this->input->post('op_estado');
        $id_doctor = $this->input->post('profesionaldiv');

        if ($id_doctor == '-1'):$id_doctor = '';
        else:$id_profesi = $id_doctor;
        endif;
        if ($servicio == '-1'):$servicio = '';
        else:$ser_consult = $servicio;
        endif;

        $where_data = array('f.estado' => $estado, 'f.aprobada' => 0);

        if (!empty($fecha_ini) and ! empty($fecha_fin)) {
            $where_data = array('f.fecha_atencion >=' => $fecha_ini, 'f.fecha_atencion <=' => $fecha_fin, 'f.estado' => $estado, 'f.aprobada' => 0);
        }
        if (!empty($servicio)) {
            $where_data = array('p.id_servicio' => $ser_consult, 'f.estado' => $estado, 'f.aprobada' => 0);
        }

        if (!empty($id_paciente)) {
            $where_data = array('f.id_cliente' => $id_paciente, 'f.estado' => $estado, 'f.aprobada' => 0);
        }

        if (!empty($id_profesi)) {
            $where_data = array('f.medico_solicitante' => $id_doctor, 'f.estado' => $estado, 'f.aprobada' => 0);
        }


        $datos['solicitud'] = $this->get_solicitud($where_data);
        $datos['num_registros'] = count($datos['solicitud']);
        $this->load->view('list_sol_pendientes', $datos);
    }

    public function get_informe($id_solicitud) {

        $solicitud = $this->paciente_fisiatria->get_solicitud($id_solicitud);
        $datos['solicitud'] = $this->paciente_fisiatria->get_solicitud($id_solicitud);
        $datos['primer_nombre'] = $this->paciente_estadistica->get_primer_nombre($solicitud[0]->nombres);
        $datos['segundo_nombre'] = $this->paciente_estadistica->get_segundo_nombre($solicitud[0]->nombres);
        $datos['primer_apellido'] = $this->paciente_estadistica->get_primer_apellido($solicitud[0]->apellidos);
        $datos['segundo_apellido'] = $this->paciente_estadistica->get_segundo_apellido($solicitud[0]->apellidos);

        $datos['tipos_terapia'] = $this->get_tipos_terapia();

        $this->load->view('informe', $datos);
    }

    public function get_tipos_terapia() {
        $this->load->model('terapia_model');
        $datos = $this->terapia_model->getTipos();

//        $datos = $this->generic_model->get_all('hmc_tipos_terapia', 'id, tipo, otro_nombre', '');
        if ($datos) {
            return $datos;
        } else {
            return false;
        }
    }

}
