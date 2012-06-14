<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Menu_almacen extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

        /*$this->load->model("Directorio_model","directorio");
        $this->load->model("estados_model","estados");
        $this->load->model("clientes_model","clientes_");*/

	}

	public function index()
	{

     
        $data['vista']='menu_almacen/menu';
		$this->load->view('principal',$data);
	}

}