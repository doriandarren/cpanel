<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos_definiciones_m extends CI_Model {

    public $table_name = 'proyectos_definiciones';
    private $id;
    private $nombre;
    private $descripcion;
    private $objetivo_general;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*     * ****************
     * FUNCIONES GETTER
     * ***************** */

    function get_id() {
        return $this->id;
    }

    function get_nombre() {
        return $this->nombre;
    }

    function get_descripcion() {
        return $this->descripcion;
    }

    function get_objetivo_general() {
        return $this->objetivo_general;
    }

    /*     * ****************
     * FUNCIONES SETTER
     * ***************** */

    function set_variables_on($query) {
        foreach ($query->result() as $row) {
            $this->id = $row->id;
            $this->nombre = $row->nombre;
            $this->descripcion = $row->descripcion;
            $this->objetivo_general = $row->objetivo_general;
        }
    }

    function set_variables_off() {
        $this->id = 0;
        $this->nombre = '';
        $this->descripcion = '';
        $this->objetivo_general = '';
    }

    function set_id($id) {
        $this->db->where('id', $id);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->set_variables_on($query);
        } else {
            $this->set_variables_off();
        }
    }

    function set_nombre($nombre) {
        $this->db->where('nombre', $nombre);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->set_variables_on($query);
        } else {
            $this->set_variables_off();
        }
    }

    function set_descripcion($descripcion) {
        $this->db->where('descripcion', $descripcion);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->set_variables_on($query);
        } else {
            $this->set_variables_off();
        }
    }

    function set_objetivo_general($objetivo_general) {
        $this->db->where('objetivo_general', $objetivo_general);
        $this->db->select('*');
        $query = $this->db->get($this->table_name);
        if ($query->result()) {
            $this->set_variables_on($query);
        } else {
            $this->set_variables_off();
        }
    }

    function upsert($data) {
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

    /* $where recibe un array */

    function listar($where = NULL, $limit = NULL) {
        if ($where != NULL) {
            foreach ($where as $campo => $valor) {
                $this->db->where($campo, $valor);
            }
        }
        $query = $this->db->get_where($this->table_name);
        //echo "<br>".$this->db->last_query();
        //exit();
        if ($query->result()) {
            return $query->result();
        } else {
            return 0;
        }
    }

    public function eliminar($id) {
        $id = intval($id);
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
        if (empty($query)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

/* End of file proyectos_definiciones_m.php */
/* Location: ./application/model/proyectos_definiciones_m.php */
