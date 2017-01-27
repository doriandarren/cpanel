<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends MY_Public{
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
        
        $data_head['css'] = array('animate','anim-forgot');
        
        $this->load->view('head', $data_head);
        $this->load->view(strtolower($this->title_head), $datos);
        $this->load->view('footer', TRUE);
    }
    
    
    public function guardar() {         
        $this->form_validation->set_rules('id', 'Id', 'trim|required|is_natural|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_rules('acronimo', 'Acronimo', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('clave', 'Clave', 'trim|min_length[4]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('reclave', 'Reclave', 'trim|xss_clean|matches[clave]');
        
        $datos['id'] = $this->input->post("id", TRUE);
        $datos['nombre'] = $this->input->post("nombre", TRUE);
        $datos['acronimo'] = $this->input->post("acronimo", TRUE);
        $datos['email'] = $this->input->post("email", TRUE);
        $datos['clave'] = $this->input->post("clave", TRUE);
        $datos['reclave'] = $this->input->post("reclave", TRUE);
                
        $this->load->model('usuarios_m');        
        $this->usuarios_m->set_acronimo($datos['acronimo']);
        $find_id = $this->usuarios_m->get_id();
        
        $this->usuarios_m->set_email($datos['email']);
        $find_email = $this->usuarios_m->get_email();
        
        if($find_id>0){
            //mensaje de error
            $data_head['msj'] = array('alert alert-danger','Error: Ya existe un USUARIO');           
        }
        if($find_email != NULL){
            //mensaje de error
            $data_head['msj'] = array('alert alert-danger','Error: Ya existe un EMAIL');           
        }
        
        if ($this->form_validation->run() === FALSE || $find_id>0 || $find_email != NULL){
            $data_head['title_head'] = $this->title_head;
            //archivos css
            $data_head['css'] = array('animate','anim-singup');
            //carga vistas
            $this->load->view('head',$data_head);        
            $this->load->view(strtolower($this->title_head), $datos);
            $this->load->view('footer');            
        }else{ 
            //elimino reclave
            unset($datos['reclave']);            
            //convertir clave en md5
            $datos['clave'] = md5($datos['clave']);       
            //creo la fecha de registro
            $datos['fecha_creacion'] = date("Y-m-d H:i:s");
            //confirma email
            $datos['confirmar_email'] = 1;
            //tipo usuario
            $datos['usuario_tipo_id'] = 3;
            //bloqueo
            $datos['bloqueo'] = 0;
            //genera el enlace 
            $datos['confirmar_url'] = md5($datos['acronimo'])
                    . '_'.$datos['clave']
                    . '_'. md5('linkMD5DeSeguridadInternaPuraCrema');
            
            $this->load->model('usuarios_m');
            $resultado = $this->usuarios_m->upsert($datos);  
            
            if($resultado==1){
                $this->usuarios_m->set_acronimo($datos['acronimo']);
                $find_id = $this->usuarios_m->get_id();
                $md5_caracter = md5($datos['acronimo']);
                $this->session->set_userdata('verifi', 'wiza' . $md5_caracter);
                $this->session->set_userdata('id', $find_id);
                $this->session->set_userdata('usuario', $datos['acronimo']);                
                $resp_email = $this->enviarMail($datos); 
                redirect('admin/principal', 'refresh');
            }else{
                $this->msj = array('alert alert-danger','Error: Ocurrió un probema en la carga en la base datos');
                $this->index();               
            }
        }        
    }
    
    
    
}
