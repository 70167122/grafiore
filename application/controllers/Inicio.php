<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if(isset($_SESSION['login'])){
			$this->load->library("template");
		}else{
			redirect("./");
		}
		
	}

	public function index()
	{
		$vista = $this->load->view("inicio/index","",TRUE);
		
		$this->template->plantilla($vista,$js=[],$css=[]); 
		//$this->load->view('layouts/plantilla');
	}
}
