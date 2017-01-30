<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Sing_up extends MY_Public {    
    private $title_head = 'sing_up';    
    private $nombre = NULL; 
    private $acronimo = NULL;
    private $email = NULL; 
    private $clave = NULL;
    private $reclave = NULL;   
    
    /* VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger */
    private $msj = NULL;

    public function __construct() {
        parent::__construct();        
    }

    public function index() {       
                
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;
        $datos['id'] = 0;
        $datos['nombre'] = $this->nombre; 
        $datos['acronimo'] = $this->acronimo; 
        $datos['email'] = $this->email; 
        $datos['clave'] = $this->clave; 
        $datos['reclave'] = $this->reclave;
        
        $data_head['css'] = array('animate','anim-singup');
        
        $this->load->view('head', $data_head);
        $this->load->view(strtolower($this->title_head),$datos);
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
            //Datos a guardar
            $datos['clave'] = md5($datos['clave']);  
            $datos['fecha_creacion'] = date("Y-m-d H:i:s");
            $datos['confirmar_email'] = 1;
            $datos['usuarios_tipos_id'] = 3;
            $datos['bloqueo'] = 0;
            $datos['confirmar_url'] = md5($datos['acronimo'])
                    . '_'.$datos['clave']
                    . '_'. md5(date("YmdHis"));
            $datos['fecha_conexion'] = date("Y-m-d H:i:s");
            
            $this->load->model('usuarios_m');
            $resultado = $this->usuarios_m->upsert($datos);  
            
            if($resultado==1){
                $this->usuarios_m->set_acronimo($datos['acronimo']);
                $find_id = $this->usuarios_m->get_id();                
                $this->creaSesion($find_id, $datos['acronimo']);
                //$this->enviarMail($datos);    
                $resp_email = $this->enviarMail($datos);
                //var_dump($resp_email);
                //exit();                
                redirect('admin/principal', 'refresh');
            }else{
                $this->msj = array('alert alert-danger','Error: Ocurrió un probema en la carga en la base datos');
                $this->index();               
            }
        }        
    }
    
    
}


