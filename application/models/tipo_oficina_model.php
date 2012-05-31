<?php 
/**
* 
*/
class Tipo_oficina_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_tipo_oficinas_all()
	{
		$query = $this->db->query("SELECT
										tipo_oficina.id_tipo_oficina,
										tipo_oficina.nombre
										FROM
										tipo_oficina
										WHERE
										tipo_oficina.activo = 1
										GROUP BY
										tipo_oficina.id_tipo_oficina
										ORDER BY
										tipo_oficina.nombre ASC");
		return ($query->num_rows() > 0)? $query->result_array() : NULL;
			
	}

}
?>