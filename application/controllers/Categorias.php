<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION['login'])){
            $this->load->library("template");
            $this->load->model("Base_model");
		}else{
			redirect("./");
		}
    }

	public function index()
    {
        $vista = $this->load->view("categorias/index","",TRUE);
        $css = ["plugins/datatables/jquery.dataTables.min.css","plugins/datatables/dataTables.bootstrap4.min.css"];
        $js = ["plugins/datatables/jquery.dataTables.min.js","plugins/datatables/dataTables.bootstrap4.min.js","js/modulos/categorias.js"];
		$this->template->plantilla($vista,$js,$css);
    }

    public function lista(){
        $consulta = $this->Base_model->datos("tipo_producto");

        echo json_encode($consulta);
    }

    public function add(){
        $descripcion = $this->input->post("descripcion");
        $data = array("nombre" => $descripcion,"estado" => 1);

        $res = $this->Base_model->insertar("tipo_producto",$data);

        if ($res) {
            echo 1;
        }else{
            echo 0;
        }
    }

   
}
