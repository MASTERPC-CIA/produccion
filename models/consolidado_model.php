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
                , '', '', ''/* 'p.id_centro_costo' *//* group by */);
        return $data;
    }

}
