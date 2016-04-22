<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consolidado extends MX_Controller {

    function __construct() {
        parent::__construct();
        //$this->load->library('grocery_CRUD');
        $this->user->check_session();
        $this->load->model('consolidado_model');
        //$this->load->library('fisiatria/paciente_fisiatria');
        /* $this->load->library('common/paciente_estadistica');
          $this->load->library('common/paciente_consulta'); */
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
            echo tagcontent('script', "window.location.replace('" . base_url('produccion/index/') . "')");
        } else {
            echo warning_msg('No se ha podido la información');
            $this->db->trans_rollback();
            die();
        }
    }

    function get_reporte_produccion() {
        $fecha_in = $this->input->post('fechaIn');
        $fecha_fin = $this->input->post('fechaFin');

        $res['fecha_ini'] = $fecha_in;
        $res['fecha_fin'] = $fecha_fin;

        $data = $this->consolidado_model->get_reporte($fecha_in, $fecha_fin);
        //print_r($data);
        if (!empty($data)) {
            $res['data'] = $data;
            $res['datos'] = array(
                'PISC', '# HAS', 'F.DE SIEMBRA', 'D.CULTIV', 'F.DE PESCA', 'A.SEMBR', 'DENSIDAD', 'TIPO/SIEMBRA', 'GRAMOS', 'LBS.BALANC', 'kilos consumidos', 'LBS. PESCADAS', 'PRODUCC X HAS', '# LARVAS PESCADAS', '% SOBREV.', 'CONV. ALI-', '$ COSTOS MPD', '$ COSTOS LARVA', '$ COSTO MDO D-I', '$ ARRIEND', '$ COSTO IND', 'TOTAL COSTO', 'COST.X.HAS', 'COST.DIA', 'TOTAL VENTA $', 'VTA X DIA', 'UTILIDAD X PISCINA', 'UTILI X HAS', 'UTILID X DIA'
            );
            $this->load->view('print_reporte_produccion', $res);
        } else {
            echo info_msg("<br>No existe datos para mostrar");
        }
    }

    public function export_to_excel($fecha_in, $fecha_fin) {
        $res['fecha_ini'] = $fecha_in;
        $res['fecha_fin'] = $fecha_fin;

        $data = $this->form_102_model->get_reporte($fecha_in, $fecha_fin);
        if (!empty($data)) {
            $res['data'] = $data;
            $this->load->view('export_excel_reporte_produccion', $res);
        }
    }

}
