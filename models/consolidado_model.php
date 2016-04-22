<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of form_103_model
 *
 * @author satellite
 */
class Consolidado_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    // para sacar el listado del mes del form 103
    function get_reporte($fech_in, $fech_fin) {

        $where_data = array('fecha_pesca >= ' => $fech_in, 'fecha_pesca <= ' => $fech_fin);

        $join_cluase[] = array('table' => 'billing_centroscosto cc', 'condition' => 'p.id_centro_costo = cc.id');
        //$join_cluase[] = array('table' => 'billing_bodega b', 'condition' => 'p.id_piscina = b.id');

        $fields = 'p.*,cc.nombre nombreCentroCosto';

        $data = $this->generic_model->get_join("produccion p", $where_data, $join_cluase, $fields
                , '', '', 'p.id_centro_costo'/* group by */);

        return $data;
        /* $data = $this->generic_model->get_data('produccion', array('fecha_pesca >= ' => $fech_in, 'fecha_pesca <= ' => $fech_fin),'*',array('id_centro_costo' => 'ASC'));
          return $data; */
    }

    /*      $today = date("Y-m-d");
      $where_data = array('reg.fecha_registro >=' => $fech_in, 'reg.fecha_registro <=' => $fech_fin, 'reg.egreso =' => '1');

      $join_cluase[] = array('table' => 'camas_numero cam_num', 'condition' => 'reg.id_cama = cam_num.id');

      $join_cluase[] = array('table' => 'solicitud_internacion sol_int', 'condition' => 'reg.id_paciente = sol_int.si_id_paciente ', 'type' => 'left');
      /* <-----ANGEL---> */
    /*        $join_cluase[] = array('table' => 'nota_evolucion n_evol', 'condition' => 'reg.id_paciente = n_evol.id_cliente ', 'type' => 'left');
      $join_cluase[] = array('table' => 'ref_contraref_der ref', 'condition' => 'reg.id_paciente = ref.PersonaComercio_cedulaRuc and  ref.fecha_emision >= reg.fecha_registro ', 'type' => 'left');
      // $join_cluase[] = array('table' => 'nota_evo_diagnostico_alta n_evol_diag', 'condition' => 'n_evol.id = n_evol_diag.id_nota');

      $join_cluase[] = array('table' => 'billing_empleado be', 'condition' => 'be.id = sol_int.user_id', 'type' => 'left');
      $join_cluase[] = array('table' => 'billing_cargosempleado car_emp', 'condition' => 'car_emp.id = be.cargosempleado_id', 'type' => 'left');

      $join_cluase[] = array('table' => 'historial_estados_paciente his_ep', 'condition' => 'reg.id_hist_paci_estado = his_ep.id', 'type' => 'left');

      $join_cluase[] = array('table' => 'billing_cliente bc', 'condition' => 'bc.id = reg.id_paciente');
      $join_cluase[] = array('table' => 'cliente_sexo sx', 'condition' => 'bc.sexo_id = sx.id');
      $join_cluase[] = array('table' => 'bill_provincia prov', 'condition' => 'bc.provincia_id = prov.idProvincia');
      $join_cluase[] = array('table' => 'bill_parroquia parr', 'condition' => 'bc.parroquia_id = parr.idParroquia');
      $join_cluase[] = array('table' => 'bill_canton cant', 'condition' => 'bc.canton_id = cant.idCanton');

      $fields = 'n_evol.id id_nota_dev,bc.id id_cliente,bc.*,sx.nombre sexo,sol_int.id_sol_inter,car_emp.id id_cargo,car_emp.nombreCargo ,sol_int.*,his_ep.*, reg.*,prov.descripProv provincia,parr.descripPq parroquia,cant.descripCtn canton,ref.referencia,ref.derivacion,ref.ref_inversa,ref.contrareferencia,ref.r_1_servicio_2,ref.r_1_establecimiento_2,ref.r_1_institucion_sis';

      $data = $this->generic_model->get_join("registro_camas_hospitalizacion reg", $where_data, $join_cluase, $fields
      , '', '', 'reg.id'/* group by *//* );
     */
    /*      return $data;
      }

      function get_nota_devolucion($nota_de, $cedula) {
      //$data = $this->generic_model->get_data('');
      $data = $this->generic_model->get_data('nota_evolucion', array('id' => $nota_de, 'id_cliente' => $cedula));
      //   $where_data = array('reg.fecha_registro >=' => $fech_in, 'reg.fecha_registro <=' => $fech_fin, 'reg.egreso =' => '1');
      return $data;
      } */
}
