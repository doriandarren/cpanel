<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proyectos_aperturas_m extends CI_Model {
public $table_name = 'proyectos_aperturas';
private $id;
private $descripcion;
private $fecha_inicio;
private $fecha_fin;
private $inversion;
private $gastos;
private $proyectos_estatus_id;
private $proyectos_definiciones_id;
function __construct() {
            parent::__construct();      
            $this->load->database();
        }
        
        /******************
        * FUNCIONES GETTER
        ****************** */
function get_id(){
                return $this->id;
            }
function get_descripcion(){
                return $this->descripcion;
            }
function get_fecha_inicio(){
                return $this->fecha_inicio;
            }
function get_fecha_fin(){
                return $this->fecha_fin;
            }
function get_inversion(){
                return $this->inversion;
            }
function get_gastos(){
                return $this->gastos;
            }
function get_proyectos_estatus_id(){
                return $this->proyectos_estatus_id;
            }
function get_proyectos_definiciones_id(){
                return $this->proyectos_definiciones_id;
            }
/******************
        * FUNCIONES SETTER
        *******************/
function set_variables_on($query){
            foreach($query->result() as $row){
$this->id = $row->id;
$this->descripcion = $row->descripcion;
$this->fecha_inicio = $row->fecha_inicio;
$this->fecha_fin = $row->fecha_fin;
$this->inversion = $row->inversion;
$this->gastos = $row->gastos;
$this->proyectos_estatus_id = $row->proyectos_estatus_id;
$this->proyectos_definiciones_id = $row->proyectos_definiciones_id;

            }
        }
function set_variables_off() {
$this->id =0;
$this->descripcion = '';
$this->fecha_inicio = '';
$this->fecha_fin = '';
$this->inversion = '';
$this->gastos = '';
$this->proyectos_estatus_id =0;
$this->proyectos_definiciones_id =0;
}
function set_id($id){
                $this->db->where('id',$id);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_descripcion($descripcion){
                $this->db->where('descripcion',$descripcion);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_fecha_inicio($fecha_inicio){
                $this->db->where('fecha_inicio',$fecha_inicio);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_fecha_fin($fecha_fin){
                $this->db->where('fecha_fin',$fecha_fin);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_inversion($inversion){
                $this->db->where('inversion',$inversion);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_gastos($gastos){
                $this->db->where('gastos',$gastos);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_proyectos_estatus_id($proyectos_estatus_id){
                $this->db->where('proyectos_estatus_id',$proyectos_estatus_id);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_proyectos_definiciones_id($proyectos_definiciones_id){
                $this->db->where('proyectos_definiciones_id',$proyectos_definiciones_id);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
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
        if ($query->result() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /*$where recibe un array */
    function listar($where = NULL, $limit = NULL){           
        if($where!=NULL){            
            foreach ($where as $campo => $valor) {
                $this->db->where($campo,$valor);
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

    public function eliminar($id) {
        $id = intval($id);
        $this->db->where('id', $id);
        $this->db->delete($this->table_name); 
        if (empty ($query)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
/* End of file proyectos_aperturas_m.php */
/* Location: ./application/model/proyectos_aperturas_m.php */
