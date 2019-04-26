<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function lista()
	{
        $this->db->select("p.descripcion,p.precio,p.stock,p.id_tipo_producto,t.nombre,p.condicion");
        $this->db->from("producto p");
        $this->db->join("tipo_producto t","p.id_tipo_producto = t.id_tipo_producto");
        $res = $this->db->get();
        return $res->result();
    }
    
}
