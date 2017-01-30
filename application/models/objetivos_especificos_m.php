<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Objetivos_especificos_m extends CI_Model {
public $table_name = 'objetivos_especificos';
private $id;
private $nombre;
private $descripcion;
private $fecha_inicio;
private $fecha_fin;
private $porcentaje_avance;
private $proyectos_id;
private $proyectos_estatus_id;
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
function get_nombre(){
                return $this->nombre;
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
function get_porcentaje_avance(){
                return $this->porcentaje_avance;
            }
function get_proyectos_id(){
                return $this->proyectos_id;
            }
function get_proyectos_estatus_id(){
                return $this->proyectos_estatus_id;
            }
/******************
        * FUNCIONES SETTER
        *******************/
function set_variables_on($query){
            foreach($query->result() as $row){
$this->id = $row->id;
$this->nombre = $row->nombre;
$this->descripcion = $row->descripcion;
$this->fecha_inicio = $row->fecha_inicio;
$this->fecha_fin = $row->fecha_fin;
$this->porcentaje_avance = $row->porcentaje_avance;
$this->proyectos_id = $row->proyectos_id;
$this->proyectos_estatus_id = $row->proyectos_estatus_id;

            }
        }
function set_variables_off() {
$this->id =0;
$this->nombre = '';
$this->descripcion = '';
$this->fecha_inicio = '';
$this->fecha_fin = '';
$this->porcentaje_avance = '';
$this->proyectos_id =0;
$this->proyectos_estatus_id =0;
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
function set_nombre($nombre){
                $this->db->where('nombre',$nombre);
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
function set_porcentaje_avance($porcentaje_avance){
                $this->db->where('porcentaje_avance',$porcentaje_avance);
                $this->db->select('*');
                $query = $this->db->get($this->table_name);
                if($query->result()){            
                    $this->set_variables_on($query);
                }else{
                    $this->set_variables_off();
                }
            }
function set_proyectos_id($proyectos_id){
                $this->db->where('proyectos_id',$proyectos_id);
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
/* End of file objetivos_especificos_m.php */
/* Location: ./application/model/objetivos_especificos_m.php */
