<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Panel extends CI_Controller {
        public function __construct(){
		parent::__construct();
/*		$this->load->library('session');
		if(!$this->redux_auth->logged_in() ){//verificar si el el usuario ha iniciado sesion
 			redirect(base_url().'inicio');
 		//echo 'denegado';*/
		//} 	 		
		
  }//****Constructor...
	public function index()
	{
	//$this->load->view('login/acceso');
	$data['vista']='login/acceso';
    $this->load->view('principal',$data);
	}
	
}//fin clase
?>