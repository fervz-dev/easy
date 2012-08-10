<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos_model extends CI_Model {
	public function __construct()
	{
	   parent::__construct();
	   //Do your magic here
	}
public function get_permisos($id_pan)
{
$query = $this->db->query("	SELECT
							permisos.permiso
							FROM
							permisos ,
							usuarios
							WHERE
							usuarios.id=".$this->session->userdata('id')."
							AND
							usuarios.id_roles = permisos.id_roles AND
							permisos.status=1 AND
							permisos.id_pantalla=".$id_pan."");
return $query->row();
}