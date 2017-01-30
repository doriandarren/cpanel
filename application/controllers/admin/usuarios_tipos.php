<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class usuarios_tipos extends MY_Admin {
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger  */

    public $msj = NULL;
    private $title_head = 'Usuarios_tipos';
    private $directorio = 'admin/';

    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_tipos_m');
    }

    public function index() {
        $data['title_head'] = $this->title_head;
        $data['msj'] = $this->msj;

        $datos['datos'] = $this->usuarios_tipos_m->listar();

        //JS PUBLICOS
        $data['js'] = array('tablas/jquery.dataTables', 'tablas/dataTables.bootstrap', 'tablas/mi_tabla');

        $this->breadCrumbs[] = array('text' => 'usuarios_tipos');

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

        $this->usuarios_tipos_m->set_id($id);
        $datos['id'] = $this->usuarios_tipos_m->get_id();
        $datos['descripcion'] = $this->usuarios_tipos_m->get_descripcion();
        $datos['estatus'] = $this->usuarios_tipos_m->get_estatus();

        $this->breadCrumbs[] = array('text' => 'Usuarios_tipos', 'href' => site_url($this->directorio . 'usuarios_tipos'));
        if ($id === 0) {
            $this->breadCrumbs[] = array('text' => 'Crear');
        } else {
            $this->breadCrumbs[] = array('text' => 'Editar');
        }
        $this->load->view($this->directorio . 'plantilla/head', $data);
        $this->load->view($this->directorio . 'usuarios_tipo', $datos);
        $this->load->view($this->directorio . 'plantilla/footer');
    }

    public function guardar() {
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['descripcion'] = $this->input->post("descripcion", TRUE);
        $datos['estatus'] = $this->input->post("estatus", TRUE);
        $this->form_validation->set_rules('id', 'Id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('estatus', 'Estatus', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {

            $data['title_head'] = $this->title_head;
            $data['msj'] = array('alert alert-danger', 'Error: No se guardaron los datos');

            $this->load->view($this->directorio . 'plantilla/head', $data);
            $this->load->view($this->directorio . 'usuarios_tipo', $datos);
            $this->load->view($this->directorio . 'plantilla/footer');
        } else {

            $resultado = $this->usuarios_tipos_m->upsert($datos);
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

        $resultado = $this->usuarios_tipos_m->eliminar($id);
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

/* End of file usuarios_tipos.php */
        /* Location: ./application/controller/usuarios_tipos.php */
