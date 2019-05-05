<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function login($usuario,$password)
	{
        $this->db->select("p.nombres,p.apellidos,u.id_perfil,u.usuario,u.id_usuario,pe.descripcion,p.id_persona");
        $this->db->from("usuario u");
        $this->db->join("perfil pe","u.id_perfil = pe.id_perfil");
        $this->db->join("persona p","u.id_persona = p.id_persona");
        $this->db->where("u.usuario",$usuario);
        $this->db->where("u.password",$password);
        $res = $this->db->get();

        if($res->num_rows() > 0){
            return $res->row();
        }else{
            return false;
        }
	}
}
