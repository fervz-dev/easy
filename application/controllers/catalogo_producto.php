<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo_producto extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
    	   $this->load->model('catalogo_producto','producto');
    	   $this->load->model('resistencia_mprima_model','resistencia');
    	   $this->load->model('archivo_model','archivo');


       if(!$this->redux_auth->logged_in()){//verificar si el el usuario ha iniciado sesion
            redirect(base_url().'inicio/logout');
        //echo 'denegado';
        }
        //inicializamos las variables MENU Y SUBMENU, por si no se enviaran desde la url
        $menu=0;
        $submenu=0;
        //verificamos si se enviaron las variables GET->m "(menu)" GET->submain"(submenu)"
        if (isset($_GET['m'])||isset($_GET['submain'])) {
            //si se enviaorn las variables GET condicionamos que sean solo numericas
            if (!is_numeric($_GET['m']) || !is_numeric($_GET['submain'])) {
                //si no son numericas que cierre la session actual
                 redirect(base_url().'inicio/logout');
            }else{
                //en caso de que si fueran numericas agregamos la variables GET a las variables previamente creadas.
                $menu=$_GET['m'];
                $submenu=$_GET['submain'];
                //validamos el menu y submenu
                $this->permisos->permisosURL($menu,$submenu);
               }
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