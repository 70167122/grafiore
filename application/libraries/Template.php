<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

	protected $CI;

	public function __construct(){
		$this->CI =& get_instance();
	}

    public function plantilla($view,$js,$css)
    {
    	$data = array(
    		"css" => $css,
			"header" => $this->CI->load->view("layouts/header","",TRUE),
			"menu" => $this->CI->load->view("layouts/menu","",TRUE),
			"content" => $view,
			"footer" => $this->CI->load->view("layouts/footer","",TRUE),
			"js" => $js
		);

		$this->CI->load->view("layouts/plantilla",$data);
    }
}