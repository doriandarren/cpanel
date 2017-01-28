<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacion extends MY_Public {
    
    private $usuario = '';
    private $pass = '';
    private $title_head = 'Autenticacion1';
    /*
     * VARIABLES CON MSJ: 
     * alert alert-info| alert alert-success |  alert alert-danger*/
    private $msj = NULL;

    public function __construct() {
        parent::__construct();        
        $this->load->model('usuarios_m');
    }

    public function index() {
        $data['usuario'] = $this->usuario;
        $data['pass'] = $this->pass;
        /* variables: info - error - exito */
        $data['msj'] = $this->msj;
        $data['title_head'] = $this->title_head;
        
        $data['css'] = array('login','animate-custom');
        
        $this->load->view('head', $data);
        $this->load->view(strtolower($this->title_head));
        $this->load->view('footer', TRUE);
    }

    function autenticar() {        
        if (!$this->input->post()) {
            $this->msj = array('alert alert-danger', 'Error: Acceso indebido');
            $this->index();
        }
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|xss_clean');
        if ($this->input->post()) {
            $usuario = $this->input->post("usuario", TRUE);
            $pass = $this->input->post("pass", TRUE);

            if ($this->form_validation->run() === FALSE) {
                $this->usuario = $usuario;
                $this->pass = $pass;
                $this->index();
            } else {
                $data['acronimo'] = $usuario;
                $data['clave'] = md5($pass);
                $data['bloqueo'] = 0;
                //$this->load->model('usuarios_m');
                $query = $this->usuarios_m->listar($data);
                if ($query) {
                    $id = $query[0]->id;
                    $usuario = $query[0]->acronimo;
                    $this->creaSesion($id,$usuario);
                    $datos['id'] = $id;
                    $datos['fecha_conexion'] = date("Y-m-d H:i:s");
                    $res = $this->usuarios_m->upsert($datos);                    
                    if ($res) {
                        redirect('admin/Principal/', 'refresh');
                    } else {
                        $this->msj = array('alert alert-danger', 'Error: ocacionado por el sistema. Consulte al Administrador');
                        $this->index();
                    }
                } else {
                    $this->msj = array('alert alert-danger', 'Error: no esta registrado o bloqueado');
                    $this->index();
                }
            }
        } else {
            $this->msj = array('alert alert-danger', 'Error: Acceso indebido');
            $this->index();
        }
    }

    public function validar_url($link) {        
        // $arrayLink_url[2]: clave usuario
        $arrayLink_url = explode("_", $link);
        $this->usuarios_m->set_confirmar_url($link, $arrayLink_url[2]);    
        $id = $this->usuarios_m->get_id();
        $usuario = $this->usuarios_m->get_acronimo();
        $clave = $this->usuarios_m->get_clave();       
        if($id!=0 && $usuario!=NULL && $clave!=NULL){
            $this->creaSesion($id, $usuario);            
            $datos['id'] = $id;
            $datos['confirmar_email'] = 0;
            $datos['fecha_conexion'] = date("Y-m-d H:i:s");
            $resp = $this->usuarios_m->upsert($datos);
            if($resp){
                $data['title_head']='Principal';
                $data['msj'] = array('alert alert-success', 'Correo confirmado exitosamente. Gracias!');
                $this->load->view('admin/plantilla/head', $data);
                $this->load->view('admin/principal');
                $this->load->view('admin/plantilla/footer', TRUE);
            }
            
            //redirect('admin/Principal/', 'refresh');
        }        
    }
    
    public function logout() {
        $this->cerrarSesion();
        $this->msj = array('alert alert-info', 'Has cerrado sesión correctamente');
        $this->index();
    }       
    
}
