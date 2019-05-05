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

    public function datos_id($nombre_id,$id,$tabla){
        $this->db->where($nombre_id,$id);
        $res = $this->db->get($tabla);
        return $res->row();
    }

    public function actualizar($nombre_id,$id,$tabla,$data){
        $this->db->where($nombre_id,$id);
        return $this->db->update($tabla,$data);
    }

    public function buscar_cliente($documento)
	{
        $this->db->select("p.nombres,p.apellidos,p.direccion,p.telefono,p.email,p.documento_identidad,c.id_cliente,c.id_persona");
        $this->db->from("persona p");
        $this->db->join("cliente c","c.id_persona = p.id_persona");
        $this->db->where("p.documento_identidad",$documento);
        $res = $this->db->get();
        
        if ($res->num_rows() > 0) {
            return $res->row();
        }else{
            return false;
        }
    }

}
