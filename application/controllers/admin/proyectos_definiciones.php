<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class proyectos_definiciones extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */

    public $msj = NULL;
    private $title_head = 'Proyectos_definiciones';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('proyectos_definiciones_m');
    }

    public function index() {
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

        $datos['datos'] = $this->proyectos_definiciones_m->listar();

        //JS PUBLICOS
        $data['js'] = array('tablas/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        $this->breadCrumbs[] = array('text' => 'proyectos_definiciones');

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

        $this->proyectos_definiciones_m->set_id($id);
        $datos['id'] = $this->proyectos_definiciones_m->get_id();
        $datos['nombre'] = $this->proyectos_definiciones_m->get_nombre();
        $datos['descripcion'] = $this->proyectos_definiciones_m->get_descripcion();
        $datos['objetivo_general'] = $this->proyectos_definiciones_m->get_objetivo_general();

        $this->breadCrumbs[] = array('text' => 'Proyectos_definiciones', 'href' => site_url($this->directorio . 'proyectos_definiciones'));
        if ($id === 0) {
            $this->breadCrumbs[] = array('text' => 'Crear');
        } else {
            $this->breadCrumbs[] = array('text' => 'Editar');
        }
        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . 'proyectos_definicione', $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function guardar() {
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['nombre'] = $this->input->post("nombre", TRUE);
        $datos['descripcion'] = $this->input->post("descripcion", TRUE);
        $datos['objetivo_general'] = $this->input->post("objetivo_general", TRUE);
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('objetivo_general', 'Objetivo General', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {

            $data['title_head'] = $this->title_head;
            $data['msj'] = array('alert alert-danger', 'Error: No se guardaron los datos');

            $this->load->view($this->directorio . 'plantilla/head', $data);
            $this->load->view($this->directorio . 'proyectos_definicione', $datos);
            $this->load->view($this->directorio . 'plantilla/footer');
        } else {

            $resultado = $this->proyectos_definiciones_m->upsert($datos);
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

        $resultado = $this->proyectos_definiciones_m->eliminar($id);
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

/* End of file proyectos_definiciones.php */
        /* Location: ./application/controller/proyectos_definiciones.php */
