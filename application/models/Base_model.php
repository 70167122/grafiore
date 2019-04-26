<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model {

	public function datos($tabla)
	{
        $this->db->where("estado",1);
        $res = $this->db->get($tabla);
        return $res->result();
    }
    
    public function insertar($tabla,$data){
       return $this->db->insert($tabla,$data);
    }
}
