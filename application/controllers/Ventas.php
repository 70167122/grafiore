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

    public function agregar(){
        $total = $this->input->post("total");
        $serie = $this->input->post("serie");
        $numero = $this->input->post("numero");
        $idcliente = $this->input->post("documento_identidad");
        $tipo_venta = $this->input->post("tipo_venta");
        $comprobante = $this->input->post("comprobante");
        $entrega = $this->input->post("entrega");
        $detalle = $this->input->post("detalle");
        $idproductos = $this->input->post("idproducto");

        $fecha = date("Y-m-d H:i:s");
        $empleado = $_SESSION['idpersona'];
        
        $datos_empleado = $this->Base_model->datos_id("id_persona",$empleado,"empleado");
        
        $id_empleado = $datos_empleado->id_empleado;
        
        $data_venta = array(
            "fecha" => $fecha,
            "total" => $total,
            "monto_recibido" => "",
            "serie" => $serie,
            "numero" => $numero,
            "id_cliente" => $idcliente,
            "id_empleado" => $id_empleado,
            "id_tipo_venta" => $tipo_venta,
            "id_tipo_documento" => $comprobante,
            "estado" => 1,
            "entrega" => $entrega
        );

        $res = $this->Base_model->insertar("venta",$data_venta);

        if ($res) {
            $id_venta = $this->db->insert_id();
            $long = count($detalle);
            for ($i=0; $i < $long; $i++) { 
                $idproduct = $idproductos[$i];
                $cantidad = $detalle[$i][0];
                $descripcion = $detalle[$i][2];
                $precio = $detalle[$i][3];
                $data_detalle = array(
                    "id_venta" => $id_venta,
                    "id_producto" => $idproduct,
                    "cantidad" => $cantidad,
                    "precio" => $precio,
                    "descripcion" => $descripcion
                );

                $this->Base_model->insertar("detalle_venta",$data_detalle);

                $producto = $this->Base_model->datos_id("id_producto",$idproduct,"producto");

                if ($producto->condicion == 1) {
                    $new_stock = $producto->stock - $cantidad;
                    $data_p = array("stock" => $new_stock);
                    $this->Base_model->actualizar("id_producto",$idproduct,"producto",$data_p);
                }

            }

            echo 1;

        }else{
            echo 2;
        }

    }
    
}
