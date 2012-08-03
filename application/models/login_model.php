<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	public function __construct()
{
   parent::__construct();
   //Do your magic here
}
	public function login($username,$password)
	{
		$query=$this->db->query("SELECT
									usuarios.id,
									usuarios.id_roles,
									usuarios.oficina_id_oficina
									FROM
									usuarios
									WHERE
									usuarios.user = '".$username."' AND
									usuarios.password = '".$password."' AND
									usuarios.status = 1");

		if ($query->num_rows()> 0) {
			return true;
		}else{
			return false;
		}

	}
	public function logout(){
		$this->ci->session->unset_userdata('id');
		$this->ci->session->unset_userdata('rol');
		$this->ci->session->unset_userdata('oficina');
		$this->ci->session->sess_destroy();
	}
}