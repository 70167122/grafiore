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
        $data['comprobante'] = $this->Base_model->datos("tipo_documento");
        $data['documento'] = $this->Base_model->datos("identidad");
        $data['tipo_venta'] = $this->Base_model->datos("tipo_venta");
        $this->load->view("ventas/new_venta",$data);
    }

    public function documento(){
        $res = $this->Base_model->datos("identidad");
        $opciones = "";

        foreach ($res as $key => $value) {
            if ($key != 1) {
                $opciones .= "<option value='".$value->id_identidad."'>".$value->descripcion."</option>";
            }
        }

        echo $opciones;
    }

    public function cliente_buscar(){
        $buscar = $this->input->post("buscar");

        $consulta = $this->Base_model->buscar_cliente($buscar);

        if ($consulta) {
            $data = array(
                "datos" => $consulta,
                "mensaje" => "ok"
            );
            echo json_encode($data);
        }else{
            $data = array(
                "datos" => "",
                "mensaje" => "No existe el cliente"
            );
            
            echo json_encode($data);
        }
        
    }

    public function traer_productos(){
        $consulta = $this->Base_model->datos("producto");

        echo json_encode($consulta);
    }

    public function producto(){
        $id = $this->input->post("id_producto");
        $consulta = $this->Base_model->datos_id("id_producto",$id,"producto");

        echo json_encode($consulta);
    }
    
}
