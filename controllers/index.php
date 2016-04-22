<?php

class index extends MX_Controller{
    
    
     function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('date'); // para extraer fecha y hora
        $this->user->check_session(); //para obtener y verificar el usuario logeado 
        $this->load->model('generic_model'); // LIBRERIA DE CONSULTAS SIN GROCERY
        $this->load->library('docident'); // validacion de cedulas ruc etc
    }
    
    
     function index() {
        $datos['listcentrocosto'] = $this->generic_model->get('billing_centroscosto');
        $datos['listbodega'] = $this->generic_model->get('billing_bodega');
        
        $res['view'] = $this->load->view('view_consolidado', $datos, TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);
        $this->load->view('common/templates/dashboard_lte', $res);
    }
    
    public function reporte_consolidado() {        
        $res['view'] = $this->load->view('search_produccion', '', TRUE);
        $res['slidebar'] = $this->load->view('slidebar', '', TRUE);

        $this->load->view('common/templates/dashboard_lte', $res);
    }
}