<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reporte extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('grocery_CRUD');
        $this->user->check_session();
        $this->load->library('fisiatria/paciente_fisiatria');
        $this->load->library('common/paciente_estadistica');
        $this->load->library('fisiatria/reporte_fisiatria');
    }

    public function index() {
        $send['mes'] = $this->generic_model->get_all('bill_mes');
        $send['anio'] = array('2016', '2017','2018','2019','2020');
        $res['view'] = $this->load->view('reportes/reporte_menu', $send, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        $this->load->view('common/templates/dashboard_lte', $res);
    }

    public function get_reporte() {
        $anio = $this->input->post('anio');
        $mes = $this->input->post('mes');
        $tipo = $this->input->post("tipo_reporte");
        if ($tipo == 1) {
            $datos['encabezado'] = $this->get_encabezadoPatologias($anio);
            $datos['cuerpo'] = $this->get_resumenPatologias($anio, $mes);

            if ($mes != 13) {

                $datos['pie'] = null;
            }
            if ($mes == -1) {

                $datos['pie'] = $this->get_piePatalogias($anio);
            }
            $this->load->view('reportes/reporte_patologias', $datos);
        } else {
            $this->getTiposTerapia($anio, $mes);
        }
    }

    /*     * *************FUNCIONES PARA EL REPORTES DE PATOLOGIAS *********** */

    public function get_encabezadoPatologias($anio) {
        $encabezado = $this->reporte_fisiatria->get_diagnosticos($anio);
        return $encabezado;
    }

    public function get_resumenPatologias($anio, $mes_input) {
        $send;
        $cont = 0;
        if ($mes_input != -1) {
            $mes = $this->generic_model->get('bill_mes m', array('id' => $mes_input), 'm.*');
        } else {
            $mes = $this->reporte_fisiatria->get_mes();
        }
        //diagnosticos obtenidos 
        $diag = $this->reporte_fisiatria->get_diagnosticos($anio);
        foreach ($mes as $val) {
            $totales = "";
            $all_total = "";
            if ($diag) {
                foreach ($diag as $item)  {
                    $total = $this->reporte_fisiatria->get_countDiagnosticos_mes($anio, $val->id, $item->cod_diag);
                    $totales.="<td>" . $total . "</td>";
                    $all_total = $total + $all_total;
                }
                $send[$cont] = (Object) array('mes' => $val->mes, 'totales' => $totales . "<td>" . $all_total . "</td>");
                $cont++;
            }else{
                 echo warning_msg("No se han encontrado resultados");
                 die();
            }
        }
        return $send;
    }

    public function get_piePatalogias($anio) {
        $pie = "";
        $total_final = 0;
        $diag = $this->reporte_fisiatria->get_diagnosticos($anio);
        foreach ($diag as $item_final) {
            $total = $this->reporte_fisiatria->get_count_all_diagnosticos($anio, $item_final->cod_diag);
            $pie.="<td>" . $total . "</td>";
            $total_final = $total_final + $total;
        }
        return "<td>TOTAL</td>" . $pie . "<td>" . $total_final . "</td>";
    }

    /*     * ********************FUNCTIONES PARA EL REPORTE TIPOS TERAPIA************************ */

    public function getTiposTerapia($anio, $mes) {
        $result['mes'] = $mes;
        $result['anio'] = $anio;
        $result['medico'] = $this->user->nombres . " " . $this->user->apellidos;
        $result['fecha_actual'] = date("Y-m-d");
        
//        $result['grado'] = $this->reporte_fisiatria->llenar_matriz_cliente_tipo($mes, $anio);
//        $result['servicio'] = $this->reporte_fisiatria->get_countServicio($anio, $mes);
//        $result['subsecuente'] = $this->reporte_fisiatria->get_subsecuente ($mes, $anio);
//        $result['una_vez'] = $this->reporte_fisiatria->get_unavez($mes, $anio);
        
                
//        $servicio = $this->reporte_fisiatria->get_countServicio($anio, $mes);
//        $terapias = $this->reporte_fisiatria->get_tiposTerapia($anio, $mes);
//            $terapiasXservicio="";
//        if ($terapias) {
//            foreach ($terapias as $val) {
//                $i = 0;
//                foreach ($servicio as $item) {
//                    $query = $this->reporte_fisiatria->get_tiposTerapisXservicio($anio, $mes, $item->id, $val->tipo_terapia);
//                    
//                    $trpXser[$i] = (object) array('servicio' => $item->prefix, 'total' => $query[0]->tipo);
//                    $i++;
//                }
//                $terapiasXservicio[$count] = (object) array('terapia' => $val->tipo,
//                            'servicios' => $trpXser);
//                $count++;
//            }
//        }
        
        $result['terapias'] = $this->cuerpo_terapias($mes, $anio);
        $this->load->view('reportes/terapias', $result);
    }
    //funcion que almacenara obtendra el resultado del reporte comandamos como parametro el mes y año
    public function cuerpo_terapias($mes, $anio){
        
        $resultado="";
        //la variable $i representara el dia.
        for ($i=1; $i<=31; $i++){
            $consulta_externa = $this->reporte_fisiatria->get_countServicio($anio,$mes, $i, 1);
            $hospitalizacion = $this->reporte_fisiatria->get_countServicio($anio,$mes, $i, 2);
            $total_con_hosp = $consulta_externa+ $hospitalizacion;

            $resultado[$i] = (object) array
                                (//la variable i significara el dia por las contabilizaciones
                                 'dia'=>$i,
                                 //numero de trapitas que    

                                 'num_terapistas'=>1,
                                  //cliente tipo grado militar de servicio activo
                                 'msa'=>$this->reporte_fisiatria->get_count_client_tipo(1,$mes,$anio, $i),
                                 //cliente tipo grado militar de servicio pasivo
                                 'msp'=>$this->reporte_fisiatria->get_count_client_tipo(2,$mes,$anio, $i),
                                  //cliente tipo grado militar de servicio conscriptos
                                 'captos'=>$this->reporte_fisiatria->get_count_client_tipo(10,$mes,$anio, $i),
                                  //cliente tipo grado militar de servicio familiar
                                'fam'=>$this->reporte_fisiatria->get_count_fam($mes,$anio, $i),
                                 //cliente tipo grado militar de servicio civil
                                'civil'=>$this->reporte_fisiatria->get_count_client_tipo(14,$mes,$anio, $i),
                                 //se manda como parametro el servicio 1 que pertenece a consulta externa
                                 //Siempre y cuando no se cambien los Id en la tabla bill_sttiposervicio 
                                 'con_exte'=>$this->reporte_fisiatria->get_countServicio($anio,$mes, $i, 1),
                                  //servicio 2 de hospitalizacion  
                                 'hosp'=>$this->reporte_fisiatria->get_countServicio($anio,$mes, $i, 2),
                                 //total de consulta externa y hospitalizacion
                                 'total_con_hosp'=>  $total_con_hosp,
                                 //Mandamos 1 por que queremos el una_vez
                                 'una_vez' =>$this->reporte_fisiatria->get_sub_secuente_una_vez($mes, $anio,1,$i),
                                 //Mandamos 2 para el subsecuente
                                 'sub_secuente' =>$this->reporte_fisiatria->get_sub_secuente_una_vez($mes, $anio,2,$i),
                                 //ELECTRO se manda como parametros el anio,el mes el 1 como id de servicio consulta externa,
                                  //  y 1 como el id_del tipo de terapia, y el dia
                                 'electro_c' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,1,1,$i),
                                 //mandamos para q consutto todo lo de hozpitalizacion
                                 'electro_h' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,2,1,$i),
                                 //MASAJE
                                 'masaje_c' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,1,3,$i),
                                 'masaje_h' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,2,3,$i),
                                 //Comp quimica
                                 'compoquimica_c' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,1,2,$i),
                                 'compoquimica_h' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,2,2,$i),
                                  // PARAFINA
                                 'parafina_c' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,1,4,$i),
                                 'parafina_h' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,2,4,$i),
                                 //EJERCICIO TERAPEUTICO
                                 'ejer_c' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,1,5,$i),
                                 'ejer_h' =>$this->reporte_fisiatria->get_tiposTerapisXservicio($anio,$mes,2,5,$i),
                                 //ALTAS TOTALES
                                 //mandamos como paramtro el mes, $anio, $dia, id_servivio  1 para consulta y 2 para hospitalizacion
                                  'alta_c'=>$this->reporte_fisiatria->get_altas($mes, $anio, $i,1),
                                  'alta_h'=>$this->reporte_fisiatria->get_altas($mes, $anio, $i,2),
                
                
                
                                );
        }
        
        return $resultado;
        
    }

}
