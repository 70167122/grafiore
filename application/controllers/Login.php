<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Usuario_model");
    }

	public function acceso()
    {
        $usuario = $this->input->post("usuario");
        $password = $this->input->post("password");

        $consulta = $this->Usuario_model->login($usuario,$password);

        if($consulta){
            $data = array(
                "id_usuario" => $consulta->id_usuario,
                "usuario" => $consulta->usuario,
                "nombres" => $consulta->nombres,
                "apellidos" => $consulta->apellidos,
                "id_perfil" => $consulta->id_perfil,
                "perfil" => $consulta->descripcion,
                "login" => TRUE
            );

            $this->session->set_userdata($data);
            echo 1;
        }else{
            echo 0;
        }
    }

    public function cerrar(){
		$this->session->sess_destroy();
	}
}
