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

    function get_reporte_sector_costo() {

        $sector = $this->input->post('sector');
        $centro_costo = $this->input->post('centro_costo');
        $fecha_in = $this->input->post('fechaIn');
        $fecha_fin = $this->input->post('fechaFin');

        $res['sector'] = $sector;
        $res['centro_costo'] = $centro_costo;
        $res['fecha_ini'] = $fecha_in;
        $res['fecha_fin'] = $fecha_fin;

        if ($sector > 0) {
            $directos = array(
                array("SUELDOS Y JORNALES", 5010201),
                array("SERVICIOS", 501040801),
                array("UNIFORMES DE PERSONAL", 501040803),
                array("LUBRICANTES", 501040902),
                array("ALIMENTACION DE PERSONAL", 501041101),
                array("HONORARIOS", 501041201),
                array("GASTOS DE GESTION", 501041301),
                array("SEGUROAS Y REASEGUROS", 501041501),
                array("REMUNERACIONES", 502020101),
                array("APORTE AL IESS", 502020201),
                array("BENEFICIOS SOCIALES E INDEMNIZACIONE", 502020301),
                array("HONORARIOS PROFESIONALES", 502020501),
                array("MANTENIMIENTO Y REPARACIONES", 502020801),
                array("ARRIENDOS DE OFICINA", 502020901),
                array("PUBLICIDAD", 502021101),
                array("COMBUSTIBLES", 502021201),
                array("LUBRICANTES", 502021301),
                array("SEGUROS Y REASEGUROS", 502021401),
                array("GASTOS DE GESTION", 502021601),
                array("GASTOS DE VIAJE", 502021701),
                array("NOTARIOS - REGISTRADORES DE LA PROPIEDAD", 502021901),
                array("IMPUESTOS Y CONTRIBUCIONES", 502022001),
                array("SUMINISTROS DE OFICINA", 502022701),
                array("SEMINARIOS Y CURSOS DE CAPACITACION", 502022702),
                array("UNIFORMES DEL PERSONAL", 502022703),
                array("VARIOS GASTOS ADM", 502022705),
                array("INTERESES", 503010101),
                array("COMISIONES", 503010201)
            );
            $indirectos = array(
                array("DEPRECIACION DE PROPIEDAD PLANTA Y EQUIPO", 501040101),
                array("MANTENIMIENTO Y REPARACIONES", 501040601),
                array("REPUESTOS", 501040703),
                array("SERVICIOS", 501040801),
                array("ARRIENDOS Y ALQUILERES", 501040802),
                array("COMBUSTIBLES", 501040901),
                array("TRANSPORTE", 501041001),
                array("SEMINARIOS Y CURSOS PERSONAL DE CAMPO", 501041401),
                array("AGUA, ENERGIA Y TELECOMUNICACIONES", 501041801),
                array("TRANSPORTE- MOVILIZACION", 502021501),
                array("TELEFONO, AGUA, ENERGIA Y RADIOFRECUENCIA", 502021801),
                array("DEPRECIACIONES PROPIEDAD PLANTA Y EQUIPO", 502022101),
                array("OTROS SERVICIOS ADM", 502022704),
                array("GASTOS NO DEDUCIBLES", 505010101),
            );
            $res['directos'] = $directos;
            $res['indirectos'] = $indirectos;

            if ($centro_costo > 0) {
                $data_direc = $this->consolidado_model->get_reporte_costo_direc($fecha_in, $fecha_fin, $directos, $centro_costo,$sector);
                $data_indir = $this->consolidado_model->get_reporte_costo_indir($fecha_in, $fecha_fin, $indirectos, $centro_costo,$sector);
            } else {
                $data_direc = $this->consolidado_model->get_reporte_direc($fecha_in, $fecha_fin, $directos, $sector);
                $data_indir = $this->consolidado_model->get_reporte_indir($fecha_in, $fecha_fin, $indirectos, $sector);
            }
            if (!empty($data_direc) AND ! empty($data_indir)) {
                $res['data_direc'] = $data_direc;
                $res['data_indir'] = $data_indir;
                $this->load->view('print_reporte_sector_costo', $res);
            } else {
                echo info_msg("<br>No existe datos para mostrar");
            }
        } else {
            echo info_msg("<br>Seleccione un sector");
        }
    }

    public function export_to_excel_sector_costo($fecha_in, $fecha_fin,$sector, $centro_costo) {
        
        $res['sector'] = $sector;
        $res['centro_costo'] = $centro_costo;
        $res['fecha_ini'] = $fecha_in;
        $res['fecha_fin'] = $fecha_fin;

        if ($sector > 0) {
            $directos = array(
                array("SUELDOS Y JORNALES", 5010201),
                array("SERVICIOS", 501040801),
                array("UNIFORMES DE PERSONAL", 501040803),
                array("LUBRICANTES", 501040902),
                array("ALIMENTACION DE PERSONAL", 501041101),
                array("HONORARIOS", 501041201),
                array("GASTOS DE GESTION", 501041301),
                array("SEGUROAS Y REASEGUROS", 501041501),
                array("REMUNERACIONES", 502020101),
                array("APORTE AL IESS", 502020201),
                array("BENEFICIOS SOCIALES E INDEMNIZACIONE", 502020301),
                array("HONORARIOS PROFESIONALES", 502020501),
                array("MANTENIMIENTO Y REPARACIONES", 502020801),
                array("ARRIENDOS DE OFICINA", 502020901),
                array("PUBLICIDAD", 502021101),
                array("COMBUSTIBLES", 502021201),
                array("LUBRICANTES", 502021301),
                array("SEGUROS Y REASEGUROS", 502021401),
                array("GASTOS DE GESTION", 502021601),
                array("GASTOS DE VIAJE", 502021701),
                array("NOTARIOS - REGISTRADORES DE LA PROPIEDAD", 502021901),
                array("IMPUESTOS Y CONTRIBUCIONES", 502022001),
                array("SUMINISTROS DE OFICINA", 502022701),
                array("SEMINARIOS Y CURSOS DE CAPACITACION", 502022702),
                array("UNIFORMES DEL PERSONAL", 502022703),
                array("VARIOS GASTOS ADM", 502022705),
                array("INTERESES", 503010101),
                array("COMISIONES", 503010201)
            );
            $indirectos = array(
                array("DEPRECIACION DE PROPIEDAD PLANTA Y EQUIPO", 501040101),
                array("MANTENIMIENTO Y REPARACIONES", 501040601),
                array("REPUESTOS", 501040703),
                array("SERVICIOS", 501040801),
                array("ARRIENDOS Y ALQUILERES", 501040802),
                array("COMBUSTIBLES", 501040901),
                array("TRANSPORTE", 501041001),
                array("SEMINARIOS Y CURSOS PERSONAL DE CAMPO", 501041401),
                array("AGUA, ENERGIA Y TELECOMUNICACIONES", 501041801),
                array("TRANSPORTE- MOVILIZACION", 502021501),
                array("TELEFONO, AGUA, ENERGIA Y RADIOFRECUENCIA", 502021801),
                array("DEPRECIACIONES PROPIEDAD PLANTA Y EQUIPO", 502022101),
                array("OTROS SERVICIOS ADM", 502022704),
                array("GASTOS NO DEDUCIBLES", 505010101),
            );
            $res['directos'] = $directos;
            $res['indirectos'] = $indirectos;

            if ($centro_costo > 0) {
                $data_direc = $this->consolidado_model->get_reporte_costo_direc($fecha_in, $fecha_fin, $directos, $centro_costo,$sector);
                $data_indir = $this->consolidado_model->get_reporte_costo_indir($fecha_in, $fecha_fin, $indirectos, $centro_costo,$sector);
            } else {
                $data_direc = $this->consolidado_model->get_reporte_direc($fecha_in, $fecha_fin, $directos, $sector);
                $data_indir = $this->consolidado_model->get_reporte_indir($fecha_in, $fecha_fin, $indirectos, $sector);
            }
            if (!empty($data_direc) AND ! empty($data_indir)) {
                $res['data_direc'] = $data_direc;
                $res['data_indir'] = $data_indir;
                $this->load->view('export_excel_sector_costo', $res);
            } else {
                echo info_msg("<br>No existe datos para mostrar");
            }
        } else {
            echo info_msg("<br>Seleccione un sector");
        }
        

    }

}
