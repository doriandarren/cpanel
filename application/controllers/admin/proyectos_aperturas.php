<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class proyectos_aperturas extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */
    public $msj = NULL;
    private $title_head = 'Proyectos_aperturas';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('proyectos_aperturas_m');
    }

    public function index() {
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

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
        //JS PUBLICOS
        $data['js'] = array('tablas/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        $this->breadCrumbs[] = array('text' => 'Proyectos Aperturas');

        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . strtolower($this->title_head), $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function nueva($id = NULL) {
        if ($id == NULL) {
            $id = 0;
        }
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

        $this->proyectos_aperturas_m->set_id($id);
        $datos['id'] = $this->proyectos_aperturas_m->get_id();
        $datos['descripcion'] = $this->proyectos_aperturas_m->get_descripcion();
        $fecha_ini = $this->proyectos_aperturas_m->get_fecha_inicio();
        if($fecha_ini===''){
            //date("Y-m-d H:i:s");
            $datos['fecha_inicio'] = date("Y-m-d");
        }  else {
            $datos['fecha_inicio'] = $fecha_ini;
        } 
        $fecha_fin = $this->proyectos_aperturas_m->get_fecha_fin();
        if($fecha_fin===''){
            //date("Y-m-d H:i:s");
            $datos['fecha_fin'] = date("Y-m-d");
        }  else {
            $datos['fecha_fin'] = $fecha_fin;
        }    
        
        
        $datos['inversion'] = $this->proyectos_aperturas_m->get_inversion();
        $datos['gastos'] = $this->proyectos_aperturas_m->get_gastos();
        $datos['proyectos_estatus_id'] = $this->proyectos_aperturas_m->get_proyectos_estatus_id();
        $datos['proyectos_definiciones_id'] = $this->proyectos_aperturas_m->get_proyectos_definiciones_id();
        //Listar los proyectos_estatus
        $this->load->model('proyectos_estatus_m');
        $datos['lista_proyectos_estatus'] = $this->proyectos_estatus_m->listar();
        //Listar los proyectos_definiciones
        $this->load->model('proyectos_definiciones_m');
        $datos['lista_proyectos_definiciones'] = $this->proyectos_definiciones_m->listar();

        $this->breadCrumbs[] = array('text' => 'Proyectos Aperturas', 'href' => site_url($this->directorio . 'proyectos_aperturas'));
        if ($id === 0) {
            $this->breadCrumbs[] = array('text' => 'Crear');
        } else {
            $this->breadCrumbs[] = array('text' => 'Editar');
        }
        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . 'proyectos_apertura', $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function guardar() {
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['descripcion'] = $this->input->post("descripcion", TRUE);
        $fecha_inicio = $this->input->post("fecha_inicio", TRUE);
        $fecha_fin = $this->input->post("fecha_fin", TRUE);
        $datos['inversion'] = $this->input->post("inversion", TRUE);
        $datos['gastos'] = $this->input->post("gastos", TRUE);
        $datos['proyectos_estatus_id'] = $this->input->post("proyectos_estatus_id", TRUE);
        $datos['proyectos_definiciones_id'] = $this->input->post("proyectos_definiciones_id", TRUE);
        
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('inversion', 'Inversion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gastos', 'Gastos', 'trim|required|xss_clean');
        $this->form_validation->set_rules('proyectos_estatus_id', 'Proyectos Estatus Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('proyectos_definiciones_id', 'Proyectos Definiciones Id', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {  
            $data['title_head'] = $this->title_head;
            $data['msj'] = array('alert alert-danger', 'Error: No se guardaron los datos');            
            $datos['fecha_inicio'] = $fecha_inicio;
            $datos['fecha_fin'] = $fecha_fin;
            //Listar los proyectos_estatus
            $this->load->model('proyectos_estatus_m');
            $datos['lista_proyectos_estatus'] = $this->proyectos_estatus_m->listar();
            //Listar los proyectos_definiciones
            $this->load->model('proyectos_definiciones_m');
            $datos['lista_proyectos_definiciones'] = $this->proyectos_definiciones_m->listar();

            $this->load->view($this->directorio . 'plantilla/head', $data);
            $this->load->view($this->directorio . 'proyectos_apertura', $datos);
            $this->load->view($this->directorio . 'plantilla/footer');
        } else {
            $datos['fecha_inicio']= $this->fecha_bd($fecha_inicio);
            $datos['fecha_fin']= $this->fecha_bd($fecha_fin);
            $resultado = $this->proyectos_aperturas_m->upsert($datos);
            if ($resultado == TRUE) {
                redirect($this->directorio . strtolower($this->title_head) . '/mensaje/formE', 'refresh');
            } else {
                redirect($this->directorio . strtolower($this->title_head) . '/mensaje/formF', 'refresh');
            }
        }
    }

    public function eliminar($id_e) {

        if ($id_e === NULL) {
            redirect($this->directorio . strtolower($this->title_head) . '/mensaje/eliF', 'refresh');
        }
        $id = intval($id_e);

        $resultado = $this->proyectos_aperturas_m->eliminar($id);
        if ($resultado === TRUE) {
            redirect($this->directorio . strtolower($this->title_head) . '/mensaje/eliE', 'refresh');
        } else {
            redirect($this->directorio . strtolower($this->title_head) . '/mensaje/eliF', 'refresh');
        }
    }

    public function mensaje($param) {
        if ($param === 'formE') {
            $this->msj = array('alert alert-success', 'Datos Guardados');
            $this->index();
        }

        if ($param === 'formF') {
            $this->msj = array('alert alert-danger', 'Error: No se guardaron los datos');
            $this->index();
        }

        if ($param === 'eliE') {
            $this->msj = array('alert alert-success', 'Datos Eliminados');
            $this->index();
        }

        if ($param === 'eliF') {
            $this->msj = array('alert alert-danger', 'Error: No se eliminaron los datos');
            $this->index();
        }

        if ($param === 'eliAso') {
            /* CATEGORIA ESTA ASOCIADA A LA NOTICIA */
            $this->msj = array('alert alert-danger',
                'Error: no se puede eliminar porque existe asignado a una Noticia. Primero elimine la noticia.');
            $this->index();
        }
    }

}

/* End of file proyectos_aperturas.php */
        /* Location: ./application/controller/proyectos_aperturas.php */
