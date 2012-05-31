<?php 
/**
* 
*/
class Puestos_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

    public function get_puestos_all()
    {
    	$query = $this-> db->query("SELECT
											puestos.nombre,
											puestos.id_tipo_puesto
											FROM
											puestos
											WHERE
											puestos.activo = 1
											GROUP BY
											puestos.id_tipo_puesto
											ORDER BY
											puestos.nombre ASC");
    	 return ($query->num_rows() > 0)? $query->result_array() : NULL;
    }

}
?>