<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION['login'])){
            $this->load->library("template");
            $this->load->model(array("Base_model","Cliente_model"));
		}else{
			redirect("./");
		}
    }

	public function index()
	{
        $data['tipo'] = $this->Base_model->datos("identidad");
		$vista = $this->load->view("clientes/index",$data,TRUE);
        $css = ["plugins/datatables/jquery.dataTables.min.css","plugins/datatables/dataTables.bootstrap4.min.css"];
        $js = ["plugins/datatables/jquery.dataTables.min.js","plugins/datatables/dataTables.bootstrap4.min.js","js/modulos/clientes.js"];
		$this->template->plantilla($vista,$js,$css);
    }

    public function lista(){
        $consulta = $this->Cliente_model->datos();

        echo json_encode($consulta);
    }

    public function add(){
        $tipo = $this->input->post("tipo_documento");
        $direccion = $this->input->post("direccion");
        $telefono = $this->input->post("telefono");
        $email = $this->input->post("email");
        $documento = $this->input->post("numero_documento");

        if ($tipo == 1) {
            $nombres = $this->input->post("nombres");
            $apellidos = $this->input->post("apellidos");
            
        }else{
            $nombres = $this->input->post("razon");
            $apellidos = "";
        }

        $data_persona = array(
            "documento_identidad" => $documento,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "email" => $email,
            "estado" => 1,
            "id_identidad" => $tipo
        );

        $this->Base_model->insertar("persona",$data_persona);

        $id = $this->db->insert_id();

        $data = array("id_persona" => $id,"estado" => 1);

        $consulta = $this->Base_model->insertar("cliente",$data);

        $id_cliente = $this->db->insert_id();

        if ($consulta) {
            $mensajes = array(
                "ok" => 1,
                "id" => $id_cliente
            );
            echo json_encode($mensajes);
        }else{
            $mensajes = array(
                "ok" => 0,
                "id" => ""
            );
            echo json_encode($mensajes);
        }

    }
    
}
