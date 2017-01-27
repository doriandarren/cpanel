<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Admin extends CI_Controller {         
    
    public function __construct() {            
        parent::__construct();
        $id = $this->session->userdata('id');
        $usu = $this->session->userdata('usuario');
        $verf = $this->session->userdata('verifi');
        
        if (!strcasecmp($id, "")) {
            redirect('Autenticacion', 'refresh');
        }
        if (!strcasecmp($usu, "")) {
            redirect('Autenticacion', 'refresh');
        }                
        
        $md5_caracter = 'wiza'.md5($usu);        
        if ($verf != $md5_caracter) {
            redirect('Autenticacion', 'refresh');
        }
                
    }
    
    public function confirmacionEmail($id) {        
        $this->load->model('usuarios_m');
        $this->usuarios_m->setear($id);
        $conEmail = $this->usuarios_m->get_confirmar_email();
        return $conEmail;
    }
    
        
    public function fecha_usuario($param) { 
        if($param){
            $anio = substr($param, 0, 4);
            $mes = substr($param, 5, 2);
            $dia = substr($param, 8, 2);
            $fecha = $anio."-".$mes."-".$dia;        
            return $fecha;
        }
        return false;
    }
    
    public function fecha_bd($param) { 
        if($param){
            $dia = substr($param, 0, 2);
            $mes = substr($param, 3, 2);
            $anio = substr($param, 6, 4);
            return $anio."-".$mes."-".$dia;
        }
        return false;
    }
        
    public function limite_palabra($string, $length = 50, $ellipsis = "...") {
        
        $pal_sin_tag = strip_tags($string);        
        $pal_trim = trim($pal_sin_tag);
        
        $words = explode(' ', $pal_trim);
        
        if (count($words) > $length) {
            return implode(' ', array_slice($words, 0, $length)) . " " . $ellipsis;
        } else {
            return $pal_trim;
        }
    }
    
       
    /************************************ 
     * FUNCIONES PERMISOS DE USUARIOS A 
     * LOS MODULOS 
     * **********************************
     * *********************************/
    
    public function permisos_leer($des_modulo) {
        $usuario_id = $this->session->userdata('id');        
        $this->load->model('Modulos_m');
        $bus = array('ruta'=>"/".$des_modulo);
        $res = $this->Modulos_m->listar($bus);
        $modulo_id = $res[0]->id;        
        $this->load->model('Modulos_usuarios_m');
        $bus_mod = array('usuario_id'=>$usuario_id, 'modulo_id'=>$modulo_id);
        $res_m = $this->Modulos_usuarios_m->listar($bus_mod,NULL);        
        if($res_m[0]->leer == 1){
            return TRUE;
        }else{
            return FALSE;
        }     
    }
    
    public function permisos_modificar($des_modulo) {
        $usuario_id = $this->session->userdata('id');        
        $this->load->model('Modulos_m');
        $bus = array('descripcion'=>$des_modulo);
        $res = $this->Modulos_m->listar($bus);        
        $modulo_id = $res[0]->id;        
        $this->load->model('Modulos_usuarios_m');
        $bus_mod = array('usuario_id'=>$usuario_id, 'modulo_id'=>$modulo_id);
        $res_m = $this->Modulos_usuarios_m->listar($bus_mod,NULL);        
        if($res_m[0]->modificar == 1){
            return TRUE;
        }else{
            return FALSE;
        }     
    }
    
    public function permisos_eliminar($des_modulo) {
        $usuario_id = $this->session->userdata('id');        
        $this->load->model('Modulos_m');
        $bus = array('descripcion'=>$des_modulo);
        $res = $this->Modulos_m->listar($bus);        
        $modulo_id = $res[0]->id;        
        $this->load->model('Modulos_usuarios_m');
        $bus_mod = array('usuario_id'=>$usuario_id, 'modulo_id'=>$modulo_id);
        $res_m = $this->Modulos_usuarios_m->listar($bus_mod,NULL);        
        if($res_m[0]->eliminar == 1){
            return TRUE;
        }else{
            return FALSE;
        }     
    }
    
    
    public function permisos_crear($des_modulo) {
        $usuario_id = $this->session->userdata('id');        
        $this->load->model('Modulos_m');
        $bus = array('descripcion'=>$des_modulo);
        $res = $this->Modulos_m->listar($bus);        
        $modulo_id = $res[0]->id;        
        $this->load->model('Modulos_usuarios_m');
        $bus_mod = array('usuario_id'=>$usuario_id, 'modulo_id'=>$modulo_id);
        $res_m = $this->Modulos_usuarios_m->listar($bus_mod,NULL);        
        if($res_m[0]->crear == 1){
            return TRUE;
        }else{
            return FALSE;
        }     
    }
    
    /************************************ 
     * MENSAJES DE ERROR O PERSONALIZADOS
     * 
     * **********************************
     * *********************************/

    public function mensajeExito() {         
        $this->msj = array('alert alert-success','Datos Guardados');  
        $this->index();
    }  

    public function mensajeError() {
        $this->msj = array('alert alert-danger','Error: No se guardaron los datos');
        $this->index();   
    }  
    
    public function mensajeEliminados() {
        $this->msj = array('alert alert-success', 'Datos Eliminados');
        $this->index();
    }  
    
    public function mensajePersonalizado($tipo,$msj) {
        $this->msj = array($tipo,$msj);
        $this->index();
    }
    
}
