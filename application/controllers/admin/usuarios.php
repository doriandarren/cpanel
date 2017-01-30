<?php
            defined('BASEPATH') OR exit('No direct script access allowed');
        class usuarios extends MY_Admin {

            /*
            * VARIABLES CON MSJ:
            * alert alert-info | alert alert-success | alert alert-danger  */
            public $msj = NULL;
            private $title_head = 'Usuarios';
            private $directorio = 'admin/';
        
            function __construct() {
                parent::__construct();
                $this->load->model('usuarios_m');
            }

            public function index() {
                $data['title_head'] = $this->title_head;
                $data['msj'] = $this->msj;

                $datos['datos'] = $this->usuarios_m->listar();

                //JS PUBLICOS
                $data['js'] = array('tablas/jquery.dataTables','tablas/dataTables.bootstrap','tablas/mi_tabla');

                $this->breadCrumbs[] = array('text' => 'usuarios');

                $this->load->view($this->directorio . 'plantilla/head', $data);
                $this->load->view($this->directorio . strtolower($this->title_head),$datos);
                $this->load->view($this->directorio . 'plantilla/footer');
            }

            public function nueva($id=NULL) {     
                if($id==NULL){
                    $id=0;
                }
                $data['title_head'] = $this->title_head;
                $data['msj'] = $this->msj;
                
                $this->usuarios_m->set_id($id);
$datos['id']= $this->usuarios_m->get_id();
$datos['nombre']= $this->usuarios_m->get_nombre();
$datos['acronimo']= $this->usuarios_m->get_acronimo();
$datos['email']= $this->usuarios_m->get_email();
$datos['clave']= $this->usuarios_m->get_clave();
$datos['fecha_creacion']= $this->usuarios_m->get_fecha_creacion();
$datos['fecha_modificacion']= $this->usuarios_m->get_fecha_modificacion();
$datos['fecha_conexion']= $this->usuarios_m->get_fecha_conexion();
$datos['bloqueo']= $this->usuarios_m->get_bloqueo();
$datos['confirmar_email']= $this->usuarios_m->get_confirmar_email();
$datos['confirmar_url']= $this->usuarios_m->get_confirmar_url();
$datos['usuarios_tipos_id']= $this->usuarios_m->get_usuarios_tipos_id();
//Listar los usuarios_tipos
                $this->load->model('usuarios_tipos_m');
                $datos['lista_usuarios_tipos'] = $this->usuarios_tipos_m->listar();
  
                $this->breadCrumbs[] = array('text' => 'Usuarios', 'href'=>  site_url($this->directorio . 'usuarios'));
                if($id===0){
                    $this->breadCrumbs[] = array('text' => 'Crear');           
                }else{
                    $this->breadCrumbs[] = array('text' => 'Editar'); 
                }
                $this->load->view($this->directorio . 'plantilla/head',$data);        
                $this->load->view($this->directorio . 'usuario', $datos);        
                $this->load->view($this->directorio . 'plantilla/footer');        
            }
public function guardar() {
$datos['id']=$this->input->post("id", TRUE);
$datos['nombre']=$this->input->post("nombre", TRUE);
$datos['acronimo']=$this->input->post("acronimo", TRUE);
$datos['email']=$this->input->post("email", TRUE);
$datos['clave']=$this->input->post("clave", TRUE);
$datos['fecha_creacion']=$this->input->post("fecha_creacion", TRUE);
$datos['fecha_modificacion']=$this->input->post("fecha_modificacion", TRUE);
$datos['fecha_conexion']=$this->input->post("fecha_conexion", TRUE);
$datos['bloqueo']=$this->input->post("bloqueo", TRUE);
$datos['confirmar_email']=$this->input->post("confirmar_email", TRUE);
$datos['confirmar_url']=$this->input->post("confirmar_url", TRUE);
$datos['usuarios_tipos_id']=$this->input->post("usuarios_tipos_id", TRUE);
$this->form_validation->set_rules('id','Id','trim|required|xss_clean');
$this->form_validation->set_rules('nombre','Nombre','trim|required|xss_clean');
$this->form_validation->set_rules('acronimo','Acronimo','trim|required|xss_clean');
$this->form_validation->set_rules('email','Email','trim|required|xss_clean');
$this->form_validation->set_rules('clave','Clave','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_creacion','Fecha Creacion','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_modificacion','Fecha Modificacion','trim|required|xss_clean');
$this->form_validation->set_rules('fecha_conexion','Fecha Conexion','trim|required|xss_clean');
$this->form_validation->set_rules('bloqueo','Bloqueo','trim|required|xss_clean');
$this->form_validation->set_rules('confirmar_email','Confirmar Email','trim|required|xss_clean');
$this->form_validation->set_rules('confirmar_url','Confirmar Url','trim|required|xss_clean');
$this->form_validation->set_rules('usuarios_tipos_id','Usuarios Tipos Id','trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE){
            
                $data['title_head'] = $this->title_head;
                $data['msj'] = array('alert alert-danger','Error: No se guardaron los datos');
//Listar los usuarios_tipos
                $this->load->model('usuarios_tipos_m');
                $datos['lista_usuarios_tipos'] = $this->usuarios_tipos_m->listar();

            $this->load->view($this->directorio . 'plantilla/head',$data);        
            $this->load->view($this->directorio . 'usuario', $datos);        
            $this->load->view($this->directorio . 'plantilla/footer');            
        }else{            
            
            $resultado = $this->usuarios_m->upsert($datos);
            if($resultado==TRUE){
                redirect($this->directorio . strtolower($this->title_head).'/mensaje/formE', 'refresh');
            }else{
                redirect($this->directorio . strtolower($this->title_head).'/mensaje/formF', 'refresh');              
            }
        }        
    }

            public function eliminar($id_e) { 
        
        if($id_e===NULL){
            redirect($this->directorio . strtolower($this->title_head).'/mensaje/eliF', 'refresh');
        }
        $id = intval($id_e);
        
        $resultado = $this->usuarios_m->eliminar($id);
        if ($resultado === TRUE) {
            redirect($this->directorio . strtolower($this->title_head).'/mensaje/eliE', 'refresh');
        } else {
            redirect($this->directorio . strtolower($this->title_head).'/mensaje/eliF', 'refresh');
        }
    } 
public function mensaje($param) {        
        if($param==='formE'){
            $this->msj = array('alert alert-success','Datos Guardados');
            $this->index();
        }
        
        if($param==='formF'){
            $this->msj = array('alert alert-danger','Error: No se guardaron los datos');
            $this->index();
        }
        
        if($param==='eliE'){
            $this->msj = array('alert alert-success', 'Datos Eliminados');
            $this->index();
        }
        
        if($param==='eliF'){
            $this->msj = array('alert alert-danger', 'Error: No se eliminaron los datos');
            $this->index();
        }
        
        if($param==='eliAso'){
            /*CATEGORIA ESTA ASOCIADA A LA NOTICIA*/
            $this->msj = array('alert alert-danger',
            'Error: no se puede eliminar porque existe asignado a una Noticia. Primero elimine la noticia.');
            $this->index();
        }
    }
        }
        /* End of file usuarios.php */
        /* Location: ./application/controller/usuarios.php */
