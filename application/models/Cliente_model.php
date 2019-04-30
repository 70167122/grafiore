<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	public function datos()
	{
        $this->db->select("p.nombres,p.apellidos,p.direccion,p.telefono,p.email,p.documento_identidad,c.id_cliente,c.id_persona");
        $this->db->from("persona p");
        $this->db->join("cliente c","c.id_persona = p.id_persona");
        $this->db->where("c.estado",1);
        $res = $this->db->get();
        return $res->result();
    }


}
