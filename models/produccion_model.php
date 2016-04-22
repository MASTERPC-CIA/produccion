<?php

class terapia_model extends CI_Model {
    /* AUTHOR: Jose Luis
     */
    /*
      38527	COMPRESAS QUÍMICAS
      38529	PARAFINA
      38537	MASAJES
      40527	ELECTROTERAPIA
      40528	EJERCICIO TERAPEUTICO
     */

    private $cod_compresasQuimicas;
    private $cod_parafina;
    private $cod_masajes;
    private $cod_electroterapia;
    private $cod_ejercicioTerapeutico;
    private $grupo_electroterapia;
    private $grupo_ejercicioTerapeutico;
    private $arrayCodigosProducto;

    function __construct() {
        parent::__construct();
        $this->cod_compresasQuimicas = 38527;
        $this->cod_parafina = 38529;
        $this->cod_masajes = 38537;
        $this->cod_electroterapia = 40527;
        $this->cod_ejercicioTerapeutico = 40528;
        $this->grupo_electroterapia = 914;
        $this->grupo_ejercicioTerapeutico = 916;
        //Array que contiene los codigos principales de producto
        $this->arrayCodigosProducto = array(
            $this->cod_compresasQuimicas,
            $this->cod_parafina,
            $this->cod_masajes,
            $this->cod_electroterapia,
            $this->cod_ejercicioTerapeutico
        );
    }

    /* Extrae los tipos de terapia desde billing_producto */

    function getTipos() {
        //codigo productos
        $fields = 'codigo id, nombreUnico tipo';
        $this->db->select($fields);
        $this->db->from('billing_producto prod');
        $codigos = $this->arrayCodigosProducto;
        $this->db->where_in('codigo', $codigos);
        $query = $this->db->get();
        if ($query->row()) {
            return $query->result();
        } else {
            return -1;
        }
    }

    /* Extrae las sub-terapias */

    function getSubTerapias($codTerapia) {
        switch ($codTerapia) {
            case $this->cod_electroterapia:
                $fields = 'codigo id, nombreUnico tipo';
                $this->db->select($fields);
                $this->db->from('billing_producto prod');
                $this->db->where('prod.marca_id', $this->grupo_electroterapia);
                $query = $this->db->get();
                return $query->result();
            case $this->cod_ejercicioTerapeutico:
                $fields = 'codigo id, nombreUnico tipo';
                $this->db->select($fields);
                $this->db->from('billing_producto prod');
                $this->db->where('prod.marca_id', $this->grupo_ejercicioTerapeutico);
                $query = $this->db->get();
                return $query->result();

            default:
                break;
        }
    }
    
    /*Guarda las terapias en hmc_tp_terapia_informe*/
    function save_terapias($tipo_terapia, $id_informe, $dia, $mes, $subsecuente, $altas) {
        $cont = count($tipo_terapia);
        $i = 0;
        while ($i < $cont) {
            $data = array(
                'id_informe' => $id_informe,
                'tipo_terapia' => $tipo_terapia[$i],
                'dia' => $dia[$i],
                'mes' => $mes[$i],
                'subsecuente' => $subsecuente[$i],
                'altas' => $altas[$i]
            );
            $query = $this->generic_model->save($data, 'hmc_tp_terapia_informe');
            $i++;
        }
        if ($query) {
            return true;
        }
        return false;
    }

    /*Extre el informe de las terapias*/
    function getInforme($id_informe){
         $join = array(
            '0' => array('table' => 'bill_mes m', 'condition' => 'tp.mes=m.id'),
            '1' => array('table' => 'billing_producto prod', 'condition' => 'tp.tipo_terapia=prod.codigo')
        );
        $fields = 'tp.*, m.mes as nombre, prod.nombreUnico tipo';
        $datos = $this->generic_model->get_join('hmc_tp_terapia_informe tp', 
                array('id_informe' => $id_informe), $join, $fields);

        if ($datos) {
            return $datos;
        } else {
            return false;
        }
    }
}
