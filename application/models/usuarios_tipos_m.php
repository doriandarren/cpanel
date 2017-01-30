<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios_tipos_m extends CI_Model {
public $table_name = 'usuarios_tipos';
private $id;
private $descripcion;
private $estatus;
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
function get_estatus(){
                return $this->estatus;
            }
/******************
        * FUNCIONES SETTER
        *******************/
function set_variables_on($query){
            foreach($query->result() as $row){
$this->id = $row->id;
$this->descripcion = $row->descripcion;
$this->estatus = $row->estatus;

            }
        }
function set_variables_off() {
$this->id =0;
$this->descripcion = '';
$this->estatus = '';
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
function set_estatus($estatus){
                $this->db->where('estatus',$estatus);
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
/* End of file usuarios_tipos_m.php */
/* Location: ./application/model/usuarios_tipos_m.php */
