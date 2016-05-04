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

    function get_reporte($fech_in, $fech_fin) {
        $where_data = array('fecha_pesca >= ' => $fech_in, 'fecha_pesca <= ' => $fech_fin);
        $join_cluase[] = array('table' => 'billing_centroscosto cc', 'condition' => 'p.id_centro_costo = cc.id');
        //$join_cluase[] = array('table' => 'billing_bodega b', 'condition' => 'p.id_piscina = b.id');
        $fields = 'p.*,cc.nombre nombreCentroCosto';
        $data = $this->generic_model->get_join("produccion p", $where_data, $join_cluase, $fields
                , '', '', ''/* 'p.id_centro_costo' *//* group by */);
        return $data;
    }

    function get_reporte_costo_direc($fech_in, $fech_fin, $directos, $centro_costo) {
        $where_data = array('fc.fechaCreacion >= ' => $fech_in, 'fc.fechaCreacion <= ' => $fech_fin);
        for ($i = 0; $i < count($directos); $i++) {
            $directos[$i][1] . " - ";
            $tabla = 'billing_detallefacturacompra fcd' . $i;
            $var = 'fcd' . $i;
            $sel = $var . '.totalpriceiva';
            $join_cluase[0] = array('table' => $tabla, 'condition' => $var . '.FacturaCompra_codigo = fc.codigoFacturaCompra AND ' . $var . '.cta_entrada LIKE "%' . $directos[$i][1] . '%" AND centro_costo = ' . $centro_costo);

            $fields = 'SUM(' . $sel . ') as ' . $var;
            $data[] = $this->generic_model->get_join("billing_facturacompra fc", $where_data, $join_cluase, $fields, '', '', ''/* 'p.id_centro_costo' *//* group by */);
        }
        return $data;
    }

    function get_reporte_costo_indir($fech_in, $fech_fin, $indirectos, $centro_costo) {
        $where_data = array('fc.fechaCreacion >= ' => $fech_in, 'fc.fechaCreacion <= ' => $fech_fin);
        for ($i = 0; $i < count($indirectos); $i++) {
            $indirectos[$i][1] . " - ";
            $tabla = 'billing_detallefacturacompra fcd' . $i;
            $var = 'fcd' . $i;
            $sel = $var . '.totalpriceiva';
            $join_cluase[0] = array('table' => $tabla, 'condition' => $var . '.FacturaCompra_codigo = fc.codigoFacturaCompra AND ' . $var . '.cta_entrada LIKE "%' . $indirectos[$i][1] . '%" AND centro_costo = ' . $centro_costo);

            $fields = 'SUM(' . $sel . ') as ' . $var;
            $data[] = $this->generic_model->get_join("billing_facturacompra fc", $where_data, $join_cluase, $fields, '', '', ''/* 'p.id_centro_costo' *//* group by */);
        }
        return $data;
    }

    function get_reporte_direc($fech_in, $fech_fin, $directos) {
        $where_data = array('fc.fechaCreacion >= ' => $fech_in, 'fc.fechaCreacion <= ' => $fech_fin);
        for ($i = 0; $i < count($directos); $i++) {
            $directos[$i][1] . " - ";
            $tabla = 'billing_detallefacturacompra fcd' . $i;
            $var = 'fcd' . $i;
            $sel = $var . '.totalpriceiva';
            $join_cluase[0] = array('table' => $tabla, 'condition' => $var . '.FacturaCompra_codigo = fc.codigoFacturaCompra AND ' . $var . '.cta_entrada LIKE "%' . $directos[$i][1] . '%"');

            $fields = 'SUM(' . $sel . ') as ' . $var;
            $data[] = $this->generic_model->get_join("billing_facturacompra fc", $where_data, $join_cluase, $fields, '', '', ''/* 'p.id_centro_costo' *//* group by */);
        }
        return $data;
    }

    function get_reporte_indir($fech_in, $fech_fin, $indirectos) {
        $where_data = array('fc.fechaCreacion >= ' => $fech_in, 'fc.fechaCreacion <= ' => $fech_fin);
        for ($i = 0; $i < count($indirectos); $i++) {
            $indirectos[$i][1] . " - ";
            $tabla = 'billing_detallefacturacompra fcd' . $i;
            $var = 'fcd' . $i;
            $sel = $var . '.totalpriceiva';
            $join_cluase[0] = array('table' => $tabla, 'condition' => $var . '.FacturaCompra_codigo = fc.codigoFacturaCompra AND ' . $var . '.cta_entrada LIKE "%' . $indirectos[$i][1] . '%"');

            $fields = 'SUM(' . $sel . ') as ' . $var;
            $data[] = $this->generic_model->get_join("billing_facturacompra fc", $where_data, $join_cluase, $fields, '', '', ''/* 'p.id_centro_costo' *//* group by */);
        }
        return $data;
    }

}
