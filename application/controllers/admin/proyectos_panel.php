<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos_panel extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */
    public $msj = NULL;
    private $title_head = 'Proyectos';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();        
    }

    public function index() {
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;

        
        
        //$data_head['css'] = array('jqgrid/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        
        //css PUBLICOS
        //$data_head['css'] = array('jquery-ui','jqgrid/ui.jqgrid-bootstrap','jqgrid/ui.jqgrid','jqgrid/ui.multiselect');
        
        //JS PUBLICOS
        //$data_head['js'] = array('jqgrid/grid.locale-es','jqgrid/jquery.jqgrid.min');
        
        $this->load->model('proyectos_aperturas_m');        
        $datos = $this->proyectos_aperturas_m->listar();
        
        $this->load->model('proyectos_estatus_m');
        $this->load->model('proyectos_definiciones_m');
        
        foreach ($datos as $i => $value) {    
            
            $fe = $value->fecha_inicio;
            $value->fecha_inicio = $this->fecha_usuario($fe);
            
            $fef = $value->fecha_fin;
            $value->fecha_fin = $this->fecha_usuario($fef);
            
            $this->proyectos_estatus_m->set_id($value->proyectos_estatus_id);
            $datos[$i]->des_estatus = $this->proyectos_estatus_m->get_descripcion();
            
            $this->proyectos_definiciones_m->set_id($value->proyectos_definiciones_id);
            $datos[$i]->des_proyecto = $this->proyectos_definiciones_m->get_nombre();            
        }
        
        $datos['datos'] = $datos;
        
        exit();
        
        $this->breadCrumbs[] = array('text' => 'Panel');

        $this->load->view($this->directorio . 'plantilla/head', $data_head);
        $this->load->view($this->directorio . strtolower($this->title_head), $datos);
        //$this->load->view($this->directorio . 'plantilla/footer');
    }
    
    function buscar_proyectos() {        
        $datos = $this->proyectos_aperturas_m->listar();
        echo json_encode($datos);
        
    }
    
    
}