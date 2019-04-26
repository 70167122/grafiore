<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION['login'])){
            $this->load->library("template");
            $this->load->model(array("Producto_model","Base_model"));
		}else{
			redirect("./");
		}
    }

	public function index()
    {
        $vista = $this->load->view("productos/index","",TRUE);
        $css = ["plugins/datatables/jquery.dataTables.min.css","plugins/datatables/dataTables.bootstrap4.min.css"];
        $js = ["plugins/datatables/jquery.dataTables.min.js","plugins/datatables/dataTables.bootstrap4.min.js","js/modulos/productos.js"];
		$this->template->plantilla($vista,$js,$css);
    }

    public function lista(){
        $consulta = $this->Producto_model->lista();
        echo json_encode($consulta);
    }

    public function tipo(){
        $consulta = $this->Base_model->datos("tipo_producto");
        echo json_encode($consulta);
    }

   
}
