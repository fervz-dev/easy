<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo_producto extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->model('catalogo_producto','producto');
	   $this->load->model('resistencia_mprima_model','resistencia');
	   $this->load->model('archivo_model','archivo');
	   if(!$this->redux_auth->logged_in() ){//verificar si el el usuario ha iniciado sesion
            redirect(base_url().'inicio');
        //echo 'denegado';
        }  

	}
    public function index()
    {
    	$data['resistencia']=$this->resistencia->get_resistencia_mprima_all();
    	$data['vista']='catalogo_producto/index';
    	$data['titulo']='Catalogo de Productos';
    	$this->load->view('principal', $data);
    }

     

}

/* End of file catalogo_producto.php */
/* Location: ./application/controllers/catalogo_producto.php */