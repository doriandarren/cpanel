<?php
        defined('BASEPATH') OR exit('No direct script access allowed');
        class Usuarios_tipos extends MY_Admin {
            /*
            * VARIABLES CON MSJ:
            * alert alert-info
            * alert alert-success
            * alert alert-danger
            *      */
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
                $data['js'] = array('tablas/jquery.dataTables','tablas/dataTables.bootstrap','tablas/mi_tabla');

                $this->breadCrumbs[] = array('text' => 'usuarios_tipos');

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
                
                $this->usuarios_tipos_m->setear($id);
$data['id']= $this->usuarios_tipos_m->get_id();
$data['descripcion']= $this->usuarios_tipos_m->get_descripcion();
$data['estatus']= $this->usuarios_tipos_m->get_estatus();
  
                $this->breadCrumbs[] = array('text' => 'Usuarios_tipos', 'href'=>  site_url($this->directorio . 'usuarios_tipos'));
                if($id===0){
                    $this->breadCrumbs[] = array('text' => 'Crear');           
                }else{
                    $this->breadCrumbs[] = array('text' => 'Editar'); 
                }
                $this->load->view($this->directorio . 'plantilla/head',$data);        
                $this->load->view($this->directorio . 'usuarios_tipo', $data);        
                $this->load->view($this->directorio . 'plantilla/footer');        
            }
public function guardar() {
$data['id']=$this->input->post("id", TRUE);
$data['descripcion']=$this->input->post("descripcion", TRUE);
$data['estatus']=$this->input->post("estatus", TRUE);
$this->form_validation->set_rules('id','Id','trim|required|xss_clean');
$this->form_validation->set_rules('descripcion','Descripcion','trim|required|xss_clean');
$this->form_validation->set_rules('estatus','Estatus','trim|required|xss_clean');

            if ($this->form_validation->run() === FALSE){
            
                $data['title_head'] = $this->title_head;
                $data['msj'] = array('alert alert-danger','Error: No se guardaron los datos');
            
            $this->load->view($this->directorio . 'plantilla/head',$data);        
            $this->load->view($this->directorio . 'usuarios_tipo', $data);        
            $this->load->view($this->directorio . 'plantilla/footer');            
        }else{            
            
            $resultado = $this->usuarios_tipos_m->upsert($data);
            if($resultado==TRUE){
                $this->mensajeExito();
            }else{
                $this->mensajePersonalizado('alert-danger','Error: NO se pudo guardar');                
            }
        }        
    }

            public function eliminar($id_e) { 
        
        if($id_e===NULL){
            $this->mensajePersonalizado('alert alert-danger','No existe el ID');
            $this->index();
        }
        $id = intval($id_e);
        
        $resultado = $this->usuarios_tipos_m->eliminar($id);
        if ($resultado === TRUE) {
            $this->mensajeExito();
        } else {
            $this->mensajePersonalizado('alert alert-danger','Error: no se elimino el registro'); 
        }
    } 
        }
        /* End of file usuarios_tipos.php */
        /* Location: ./application/controller/usuarios_tipos.php */
