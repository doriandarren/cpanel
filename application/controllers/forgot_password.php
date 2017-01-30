<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends MY_Public {

    private $title_head = 'forgot_password';
    private $email = NULL;
    /*
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger */
    private $msj = NULL;

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;
        $datos['email'] = $this->email;

        $data_head['css'] = array('animate', 'anim-forgot');

        $this->load->view('head', $data_head);
        $this->load->view(strtolower($this->title_head), $datos);
        $this->load->view('footer', TRUE);
    }

    public function guardar() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $datos['email'] = $this->input->post("email", TRUE);
        
        $this->load->model('usuarios_m');
        $this->usuarios_m->set_email($datos['email']);
        $find_id = $this->usuarios_m->get_id();
        $find_clave = $this->usuarios_m->get_clave();
        $find_acronimo = $this->usuarios_m->get_acronimo();
        $find_nombre = $this->usuarios_m->get_nombre();
        
        if ($this->form_validation->run() === FALSE || $find_id <= 0 || $find_acronimo === NULL) {
            $data_head['title_head'] = $this->title_head;
            $data_head['msj'] = array('alert alert-danger', 'Error...');
            //archivos css
            $data_head['css'] = array('animate', 'anim-forgot');
            //carga vistas
            $this->load->view('head', $data_head);
            $this->load->view(strtolower($this->title_head), $datos);
            $this->load->view('footer');
        } else {
            $datos['id']=$find_id;
            //confirma email
            $datos['confirmar_email'] = 1;
            //genera el enlace 
            $datos['confirmar_url'] = md5($find_acronimo)
                    . '_' . $find_clave
                    . '_' . md5('linkMD5DeSeguridadInternaPuraCrema');

            $this->load->model('usuarios_m');
            $resultado = $this->usuarios_m->upsert($datos);

            if ($resultado == 1) {
                $datos['nombre'] = $find_nombre;
                $datos['acronimo'] = $find_acronimo;
                //convertir clave en md5
                $datos['clave'] = $find_clave;
                $md5_acronimo = md5($datos['acronimo']);
                $this->session->set_userdata('verifi', 'wiza' . $md5_acronimo);
                $this->session->set_userdata('id', $find_id);
                $this->session->set_userdata('usuario', $datos['acronimo']);
                $resp_email = $this->enviarMail($datos);
                //var_dump($resp_email);
                //exit();
                redirect(strtolower($this->title_head) . '/mensaje/formE', 'refresh');
            } else {
                redirect(strtolower($this->title_head) . '/mensaje/formF', 'refresh'); 
            }
        }
    }
    
    public function mensaje($param) {
        if ($param === 'formE') {
            $this->msj = array('alert alert-success', 'Correo enviado!');
            $this->index();
        }
        if ($param === 'formF') {
            $this->msj = array('alert alert-danger', 'Error: No se pudo recuperar datos!');
            $this->index();
        }
    }

}
