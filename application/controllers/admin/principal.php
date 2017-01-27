<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends MY_Admin {    
    private $title_head = 'Principal';
    private $directorio = 'admin/';
    /* 
     * VARIABLES CON MSJ:
     * alert alert-info | alert alert-success | alert alert-danger*/
    public $msj = NULL;
    public $msj_static = NULL;
    
    function __construct() {
	parent::__construct(); 
        //verifica si tiene que confirmar correo
        $id = $this->session->userdata('id');
        $conEmail = $this->confirmacionEmail($id);
        if($conEmail==1){
            $this->msj_static = array('alert alert-info', 'Por favor, confirme su correo');
        }
    }

    function index() {        
        $data_head['title_head'] = $this->title_head;
        $data_head['msj'] = $this->msj;
        $data_head['msj_static'] = $this->msj_static;     
                
        
        $this->load->view($this->directorio.'plantilla/head',$data_head);        
        $this->load->view($this->directorio.strtolower($this->title_head));        
        $this->load->view($this->directorio.'plantilla/footer');
        
    }
    
}