<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(isset($_SESSION['login'])){
            $this->load->library("template");
            $this->load->model(array("Base_model"));
		}else{
			redirect("./");
		}
    }

	public function index()
	{
		$vista = $this->load->view("ventas/index","",TRUE);
        $css = ["plugins/datatables/jquery.dataTables.min.css","plugins/datatables/dataTables.bootstrap4.min.css"];
        $js = ["plugins/datatables/jquery.dataTables.min.js","plugins/datatables/dataTables.bootstrap4.min.js","js/modulos/ventas.js"];
		$this->template->plantilla($vista,$js,$css);
    }

    public function new_venta(){
        $this->load->view("ventas/new_venta");
    }
    
}
