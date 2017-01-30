<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class proyectos_estatus extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */

    public $msj = NULL;
    private $title_head = 'Proyectos_estatus';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('proyectos_estatus_m');
    }

    public function index() {
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

        $datos['datos'] = $this->proyectos_estatus_m->listar();

        //JS PUBLICOS
        $data['js'] = array('tablas/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        $this->breadCrumbs[] = array('text' => 'proyectos_estatus');

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

        $this->proyectos_estatus_m->set_id($id);
        $datos['id'] = $this->proyectos_estatus_m->get_id();
        $datos['descripcion'] = $this->proyectos_estatus_m->get_descripcion();

        $this->breadCrumbs[] = array('text' => 'Proyectos_estatus', 'href' => site_url($this->directorio . 'proyectos_estatus'));
        if ($id === 0) {
            $this->breadCrumbs[] = array('text' => 'Crear');
        } else {
            $this->breadCrumbs[] = array('text' => 'Editar');
        }
        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . 'proyectos_estatu', $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function guardar() {
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['descripcion'] = $this->input->post("descripcion", TRUE);
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {

            $data['title_head'] = $this->title_head;
            $data['msj'] = array('alert alert-danger', 'Error: No se guardaron los datos');

            $this->load->view($this->directorio . 'plantilla/head', $data);
            $this->load->view($this->directorio . 'proyectos_estatu', $datos);
            $this->load->view($this->directorio . 'plantilla/footer');
        } else {

            $resultado = $this->proyectos_estatus_m->upsert($datos);
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

        $resultado = $this->proyectos_estatus_m->eliminar($id);
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

/* End of file proyectos_estatus.php */
        /* Location: ./application/controller/proyectos_estatus.php */
