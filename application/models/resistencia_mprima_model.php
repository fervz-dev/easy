<?php 
/**
* 
*/
class Resistencia_mprima_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_resistencia_mprima_all()
	{
		$query = $this->db->query("SELECT
										resistencia_mprima.id_resistencia_mprima,
										resistencia_mprima.resistencia
										FROM
										resistencia_mprima
										WHERE
										resistencia_mprima.activo = 1
										GROUP BY
										resistencia_mprima.id_resistencia_mprima
										ORDER BY
										resistencia_mprima.resistencia ASC");
		return ($query->num_rows() > 0)? $query->result_array() : NULL;
			
	}

}
?>