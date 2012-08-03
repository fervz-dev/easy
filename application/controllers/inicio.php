<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends CI_Controller {
        public function __construct(){
		parent::__construct();
  }//****Constructor...
	public function index()
	{
	$this->load->view('login/index.php');
	//echo crypt('admin',2);
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//validando login de usuario
public function validar_usuario()
	{
	 $user = $this->input->post('usuario');
	 $pass = $this->input->post('password');
	 $redux =$this->redux_auth->login($user,$pass);

	 switch($redux){
	 case false:
                 $Data["ErrorDatos"]="Error en usuario/contrase&ntilde;a, verifique de nuevo por favor.";
				 $this->load->view('login/index.php',$Data);
				break;
	  case true:
	            redirect(base_url()."panel?m=1","refresh");
			    break;
	 }
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   public function logout(){
  		//termina la session
		$this->redux_auth->logout();
  		//redirecciona al formulario de login
		redirect(base_url().'inicio','refresh');
  }


}//fin clase
?>