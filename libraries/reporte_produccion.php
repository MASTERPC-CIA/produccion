<?php

/**
 * Description obtener reporte Fisiatria
 *
 * @author andrea
 */
class reporte_fisiatria extends CI_Model {

    private $ci;

    function __construct() {
        parent::__construct();
        $this->ci = & get_instance();
        $this->ci->load->model('generic_model');
    }

    function get_mes() {
        //RETORNAS TODOS LOS MESES
        $query = $this->ci->generic_model->get('bill_mes m', array('id >= ' => '1', 'id <= ' => '12'), 'm.*');

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    function get_diagnosticos($anio) {

        $fields = 'distinct(ind.cod_diag) as numero,  diag_enfermedad, ind.cod_diag';

        $join = array(
            '0' => array('table' => 'hmc_diag_informe_fisiatria ind', 'condition' => 'ind.id_informe = inf.id'),
            '1' => array('table' => 'diagnostico d', 'condition' => 'd.diag_codigo = ind.cod_diag')
        );
        $where = array('year(inf.fecha_realizada)' => $anio);


        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria  inf', $where, $join, $fields, '');

        if ($query) {
            return $query;
        } else {
            return false;
        }
    }

    //contamos el la suma de cada diagnostico por cada mes
    function get_countDiagnosticos_mes($anio, $mes, $cod_diag) {

        $fields = 'count(ind.cod_diag) as total';

        $join = array(
            '0' => array('table' => 'hmc_diag_informe_fisiatria ind', 'condition' => 'ind.id_informe = inf.id'),
        );
        $where = array(
            'year(inf.fecha_realizada)' => $anio,
            'month(inf.fecha_realizada)' => $mes,
            'ind.cod_diag' => $cod_diag
        );

        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria  inf', $where, $join, $fields, '');

        if ($query) {
            return $query[0]->total;
        } else {
            return false;
        }
    }

    //contamos la suma de cada diagnostico de todos los meses
    function get_count_all_diagnosticos($anio, $cod_diag) {
        $fields = 'count(ind.cod_diag) as total';

        $join = array(
            '0' => array('table' => 'hmc_diag_informe_fisiatria ind', 'condition' => 'ind.id_informe = inf.id'),
        );

        $where = array(
            'year(inf.fecha_realizada)' => $anio,
            'ind.cod_diag' => $cod_diag
        );

        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria  inf', $where, $join, $fields, '');

        if ($query) {
            return $query[0]->total;
        } else {
            return false;
        }
    }

    /*     * ************************************************************************************ */
    /* REPORTE  DE TERAPIA FISICA */
    //SELECCIONNAMOS Y CONTABILIZAMOS EL GRADO DISTINTO DEL PACIENTE  DE LOS INFORMES INGRESADOS
    function get_count_client_tipo($id_grado, $mes, $anio, $dia) {
        $fields = 'COUNT(ct.idclientetipo) as numero, ct.idclientetipo';
        $inner_join = array(
          
            '0' => array('table' => 'billing_cliente c', 'condition' => 'c.id = inf.id_cliente'),
            '1' => array('table' => 'billing_clientetipo  ct', 'condition' => 'c.clientetipo_idclientetipo = ct.idclientetipo'),
            '2'=>array('table'=>'hmc_tp_terapia_informe ti', 'condition'=>'inf.id= ti.id_informe' )
        );

        $where = array('ti.mes' => $mes, 'year(fecha_realizada)' => $anio, 'ct.idclientetipo' => $id_grado, 'ti.dia'=>$dia);
        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $inner_join, $fields, '', '', '');
        if ($query) {
             return $query[0]->numero;
        } else {
            return 0;
        }
    }

    function get_count_fam($mes, $anio, $dia) {
        $fields = 'COUNT(ct.idclientetipo) as numero';

        $inner_join = array(
            
            '0' => array('table' => 'billing_cliente c', 'condition' => 'c.PersonaComercio_cedulaRuc = inf.id_cliente'),
            '1' => array('table' => 'billing_clientetipo  ct', 'condition' => 'c.clientetipo_idclientetipo = ct.idclientetipo'),
            '2'=>array('table'=>'hmc_tp_terapia_informe ti', 'condition'=>'inf.id= ti.id_informe' )
            );

        $where = array( 'ti.mes' => $mes,
                        'year(fecha_realizada)' => $anio, 
                        'idclientetipo >=' => 3, 
                        'idclientetipo <=' =>8,
                        'ti.dia'=>$dia
                       );

        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $inner_join, $fields, '', '', '');

        if ($query) {
            return $query[0]->numero;
        } else {
            return 0;
        }
    }

//    public function llenar_matriz_cliente_tipo($mes, $anio) {
//        $data = array();
//        
//     //   $CIVIL =$this->get_count_client_tipo(1, $mes, $anio);
//     
//        $data[0] = $this->get_count_client_tipo(1, $mes, $anio);
//        $data[1] = $this->get_count_client_tipo(2, $mes, $anio);
//        $data[2] = $this->get_count_client_tipo(10, $mes, $anio);
//        $data[3] = $this->get_count_fam($mes, $anio);
//        $data[4] = $this->get_count_client_tipo(14, $mes, $anio);
//        
//        return $data;
//    }

    //SELECCIONAMOS Y CONTABILIZAMOS LOS SEERVICIOS DISTINTOS
    function get_countServicio($anio, $mes, $dia, $servicio) {
        $fields = 'COUNT(inf.id_servicio) as servicio';
        $inner_join = array(
          
            '0' => array('table' => 'hmc_tp_terapia_informe tp', 'condition' => 'tp.id_informe=inf.id'),
        );
        $where = array('tp.mes' => $mes, 
                       'year(fecha_realizada)' => $anio,
                       'tp.dia'=>$dia,
                       'inf.id_servicio'=>$servicio);

        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $inner_join, $fields, '', '', 'inf.id_servicio');

        if ($query) {
            return $query[0]->servicio;
        } else {
            return 0;
        }
    }

    //CONTABILIZAMOS LOS DIFERENTES TIPOS DE TERAPIA

//    function get_tiposTerapia($anio, $mes, $dia, $servicio, $tipo_terapia) {
//        $fields = 'count(tp.tipo_terapia) as numero,  tps.tipo, inf.id_servicio';
//        $inner_join = array(
//            '0' => array('table' => 'hmc_tp_terapia_informe  tp', 'condition' => 'tp.id_informe = inf.id'),
//            '1' => array('table' => 'hmc_tipos_terapia tps', 'condition' => 'tps.id = tp.tipo_terapia'),
//        );
//
//        $where = array('tp.mes' => $mes,
//                        'year(fecha_realizada)' => $anio,
//                        'tp.dia'=> $dia,
//                        'inf.id_servicio'=>$servicio,
//                        'tps.id' => $tipo_terapia);
//
//        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $inner_join, $fields, '', '', '');
//        if ($query) {
//            return $query;
//        } else {
//            return false;
//        }
//    }
    //contabilizacion las taerapias por sevicio.
    function get_tiposTerapisXservicio($anio, $mes, $id_servicio, $tipo_terapia, $dia) {
        $fields = 'count(st.tipo) as tipo';
        $inner_join = array(
            '0' => array('table' => 'bill_sttiposervicio st', 'condition' => 'st.id = inf.id_servicio'),
            '1' => array('table' => 'hmc_tp_terapia_informe  tp', 'condition' => 'tp.id_informe = inf.id'),
            '2' => array('table' => 'hmc_tipos_terapia tps', 'condition' => 'tps.id = tp.tipo_terapia'),
        );

        $where = array('tp.mes' => $mes, 
                       'year(fecha_realizada)' => $anio, 
                       'id_servicio' => $id_servicio, 
                       'tp.tipo_terapia' => $tipo_terapia,
                       'tp.dia'=>$dia);

        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $inner_join, $fields, '', '', '');
        if ($query) {
            return $query[0]->tipo;
        } else {
            return 0;
        }
    }
    //Funcion para sacar el subsecuente=2 y una vez=1 de fisiatria 1 
    //como parametros mandames el mes, año,y dia
    function get_sub_secuente_una_vez( $mes,$anio, $sub_unav, $dia){
        $fields = 'count(tp.subsecuente) as total';
        $where = array('tp.subsecuente'=>$sub_unav,
                       'tp.mes' => $mes, 
                       'year(fecha_realizada)' => $anio,
                       'tp.dia'=>$dia);
        $join = array(
            '0'=>array('table'=> 'hmc_tp_terapia_informe tp', 'condition'=>'inf.id = tp.id_informe')
        );
        $num_unave = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where, $join, $fields);
        if($num_unave){
            return  $num_unave[0]->total;
        }else{
            return 0;
        }
      
    }
    //contabilizamos cuantos fueron las altas generadas en el mes
    function get_altas($mes,$anio, $dia, $id_servicio){
        $fields= 'count(altas)as total';
        $where = array('tp.altas'=>'1', 'tp.mes'=>$mes,'year(fecha_realizada)' => $anio,'tp.dia'=>$dia,'id_servicio' => $id_servicio);
        $join = array(
            '0'=>array('table'=>'hmc_tp_terapia_informe tp', 'condition'=>'inf.id = tp.id_informe')
        );
        $query = $this->ci->generic_model->get_join('hmc_informe_fisiatria inf', $where,$join,$fields);
        
        if($query){
            return $query[0]->total; 
        }else{
            return 0;
        }
    }
    
    //Sacamos todas la terapias por tipo servicio
    function get_terapias(){
        $query = $this->ci->generic_model->get_all('hmc_tipos_terapia t','t.*', '');
        if($query){
            return $query; 
        }else{
            return false;
        }
    }
    

}
