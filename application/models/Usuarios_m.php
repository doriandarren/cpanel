<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_m extends CI_Model {
    private $table_name = 'usuarios';
    private $id; 
    private $nombre;
    private $acronimo;
    private $email;
    private $clave;
    private $fecha_creacion;
    private $fecha_modificacion;
    private $bloqueo;    
    private $usuarios_tipos_id;
    private $confirmar_email;
    private $confirmar_url;
    
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /******************
     * FUNCIONES GETTER
    *******************/
    
    function get_id() {
        return $this->id;
    }

    function get_nombre() {
        return $this->nombre;
    }

    function get_acronimo() {
        return $this->acronimo;
    }

    function get_email() {
        return $this->email;
    }

    function get_clave() {
        return $this->clave;
    }

    function get_fecha_creacion() {
        return $this->fecha_creacion;
    }

    function get_fecha_modificacion() {
        return $this->fecha_modificacion;
    }

    function get_bloqueo() {
        return $this->bloqueo;
    }

    function get_usuarios_tipos_id() {
        return $this->usuarios_tipos_id;
    }

    function get_confirmar_email() {
        return $this->confirmar_email;
    }

    function get_confirmar_url() {
        return $this->confirmar_url;
    }
    
    /******************
     * FUNCIONES SETTER
    *******************/
    
    public function set_variables_off() {
        $this->id = 0;
        $this->nombre = '';
        $this->acronimo = '';
        $this->email = '';
        $this->clave = '';
        $this->fecha_creacion = '';
        $this->fecha_modificacion = '';
        $this->bloqueo = 0;
        $this->usuarios_tipos_id = 0;
        $this->confirmar_email = 0;
        $this->confirmar_url = '';
    }

    public function set_variables_on($query) {
        foreach ($query->result() as $row) {
            $this->id = $row->id;
            $this->nombre = $row->nombre;
            $this->acronimo = $row->acronimo;
            $this->email = $row->email;
            $this->clave = $row->clave;
            $this->fecha_creacion = $row->fecha_creacion;
            $this->fecha_modificacion = $row->fecha_modificacion;
            $this->bloqueo = $row->bloqueo;
            $this->usuarios_tipos_id = $row->usuarios_tipos_id;
            $this->confirmar_email = $row->confirmar_email;
            $this->confirmar_url = $row->confirmar_url;
        }
    }

    function setear($pid){
        $id = intval($pid);
        $this->db->select('*');
        $this->db->where('id',$id);                
        $query = $this->db->get($this->table_name); 
        if($query->result()){
            $this->set_variables_on($query);
        }else{   
            $this->set_variables_off();            
        }
    }
        
    
    
    function set_acronimo($acronimo){        
        $this->db->select('*');
        $this->db->where('acronimo',$acronimo);                
        $query = $this->db->get($this->table_name); 
        if($query->result()){
            $this->set_variables_on($query);
        }else{            
            $this->set_variables_off();
        }
    }
    
    function set_email($email){        
        $this->db->select('*');
        $this->db->where('email',$email);                
        $query = $this->db->get($this->table_name); 
        if($query->result()){
            $this->set_variables_on($query);
        }else{            
            $this->set_variables_off();
        }
    }
    
    function set_confirmar_url($url, $clave=NULL){        
        $this->db->select('*');
        if($clave!=NULL){
            $this->db->where('clave',$clave);
        } 
        $this->db->where('confirmar_url',$url); 
        $this->db->get_where($this->table_name);                
        $query = $this->db->get($this->table_name); 
        //echo "<br>".$this->db->last_query();
        if($query->result()){
            $this->set_variables_on($query);
        }else{            
            $this->set_variables_off();
        }
    }    
         
    function upsert($data){        
        $this->db->where('id', $data['id']);
        $this->db->select('id');
        $query = $this->db->get($this->table_name);
                
        if ($query->result()) {            
            $this->db->set($data);
            $this->db->where('id', $data['id']);
            $this->db->update($this->table_name, $data);            
        } else {            
            unset($data['id']);
            $this->db->set($data);
            $this->db->insert($this->table_name);            
        }
        //echo "<br>".$this->db->last_query();
        if ($query->result() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }    
    
    /*ESTA FUNCION DEVUELVE TODOS LOS VALORES DE LA TABLA
     * ES OPCIONAL EL VALOR $data 
     **/
    function listar($where = NULL){           
        if($where!=NULL){            
            foreach ($where as $key => $value) {
                $this->db->where($key,$value);
            }
        }           
        $query = $this->db->get_where($this->table_name);       
        //echo "<br>".$this->db->last_query();
        //exit();
        if($query->result()){
            return $query->result();
        }else{
            return 0;
        }        
    }
    
    function eliminar($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete($this->table_name);   
        //echo "<br>".$this->db->last_query();
        
        if ($query === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
            
    /* BUSCA DESCRIPCION */
    function buscar_acronimo($acronimo){
        $this->db->where('acronimo', $acronimo);
        $query = $this->db->get_where($this->table_name);
        if($query->result()){
            return TRUE;
        }else{
            return FALSE;
        }        
    }
    
}