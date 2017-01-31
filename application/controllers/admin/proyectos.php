<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */
    public $msj = NULL;
    private $title_head = 'Proyectos';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('proyectos_aperturas_m');
    }

    public function index() {
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;

        $datos['datos'] = $this->proyectos_aperturas_m->listar();
        
        //$data_head['css'] = array('jqgrid/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        
        //css PUBLICOS
        $data_head['css'] = array('jquery-ui','jqgrid/ui.jqgrid-bootstrap','jqgrid/ui.jqgrid','jqgrid/ui.multiselect');
        
        //JS PUBLICOS
        //$data_head['js'] = array('jqgrid/grid.locale-es','jqgrid/jquery.jqgrid.min');
        
        
        $this->breadCrumbs[] = array('text' => 'Panel');

        $this->load->view($this->directorio . 'plantilla/head', $data_head);
        $this->load->view($this->directorio . strtolower($this->title_head), $datos);
        //$this->load->view($this->directorio . 'plantilla/footer');
    }
    
    function buscar_proyectos() {        
        $datos = $this->proyectos_aperturas_m->listar();
        echo json_encode($datos);
        
    }
    
    
    function agregar_proyectos() {
        $datos = new stdClass();
        $datos->sc = TRUE;   
        $datos->msg = 'bien';        
        echo json_encode($datos);
    }
    function editar_proyectos() {        
        $datos = new stdClass();
        $datos->mensaje = 'bien';        
        echo json_encode($datos);
        
    }
    function eliminar_proyectos() {
        $datos = new stdClass();
        $datos->msj = 'bien';        
        echo json_encode($datos);
    }
    
    
}