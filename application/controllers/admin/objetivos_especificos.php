<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class objetivos_especificos extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */

    public $msj = NULL;
    private $title_head = 'Objetivos_especificos';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('objetivos_especificos_m');
    }

    public function index() {
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

        $datos['datos'] = $this->objetivos_especificos_m->listar();

        //JS PUBLICOS
        $data['js'] = array('tablas/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        $this->breadCrumbs[] = array('text' => 'objetivos_especificos');

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

        $this->objetivos_especificos_m->set_id($id);
        $datos['id'] = $this->objetivos_especificos_m->get_id();
        $datos['nombre'] = $this->objetivos_especificos_m->get_nombre();
        $datos['descripcion'] = $this->objetivos_especificos_m->get_descripcion();
        $datos['fecha_inicio'] = $this->objetivos_especificos_m->get_fecha_inicio();
        $datos['fecha_fin'] = $this->objetivos_especificos_m->get_fecha_fin();
        $datos['porcentaje_avance'] = $this->objetivos_especificos_m->get_porcentaje_avance();
        $datos['proyectos_id'] = $this->objetivos_especificos_m->get_proyectos_id();
        $datos['proyectos_estatus_id'] = $this->objetivos_especificos_m->get_proyectos_estatus_id();
//Listar los proyectos
        $this->load->model('proyectos_m');
        $datos['lista_proyectos'] = $this->proyectos_m->listar();
//Listar los proyectos_estatus
        $this->load->model('proyectos_estatus_m');
        $datos['lista_proyectos_estatus'] = $this->proyectos_estatus_m->listar();

        $this->breadCrumbs[] = array('text' => 'Objetivos_especificos', 'href' => site_url($this->directorio . 'objetivos_especificos'));
        if ($id === 0) {
            $this->breadCrumbs[] = array('text' => 'Crear');
        } else {
            $this->breadCrumbs[] = array('text' => 'Editar');
        }
        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . 'objetivos_especifico', $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function guardar() {
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['nombre'] = $this->input->post("nombre", TRUE);
        $datos['descripcion'] = $this->input->post("descripcion", TRUE);
        $datos['fecha_inicio'] = $this->input->post("fecha_inicio", TRUE);
        $datos['fecha_fin'] = $this->input->post("fecha_fin", TRUE);
        $datos['porcentaje_avance'] = $this->input->post("porcentaje_avance", TRUE);
        $datos['proyectos_id'] = $this->input->post("proyectos_id", TRUE);
        $datos['proyectos_estatus_id'] = $this->input->post("proyectos_estatus_id", TRUE);
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha Inicio', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fecha_fin', 'Fecha Fin', 'trim|required|xss_clean');
        $this->form_validation->set_rules('porcentaje_avance', 'Porcentaje Avance', 'trim|required|xss_clean');
        $this->form_validation->set_rules('proyectos_id', 'Proyectos Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('proyectos_estatus_id', 'Proyectos Estatus Id', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {

            $data['title_head'] = $this->title_head;
            $data['msj'] = array('alert alert-danger', 'Error: No se guardaron los datos');
//Listar los proyectos
            $this->load->model('proyectos_m');
            $datos['lista_proyectos'] = $this->proyectos_m->listar();
//Listar los proyectos_estatus
            $this->load->model('proyectos_estatus_m');
            $datos['lista_proyectos_estatus'] = $this->proyectos_estatus_m->listar();

            $this->load->view($this->directorio . 'plantilla/head', $data);
            $this->load->view($this->directorio . 'objetivos_especifico', $datos);
            $this->load->view($this->directorio . 'plantilla/footer');
        } else {

            $resultado = $this->objetivos_especificos_m->upsert($datos);
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

        $resultado = $this->objetivos_especificos_m->eliminar($id);
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

/* End of file objetivos_especificos.php */
        /* Location: ./application/controller/objetivos_especificos.php */
