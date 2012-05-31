<?php 
/**
* 
*/
class Estados_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

    public function get_estados_all()
    {
    	$query = $this-> db->query("SELECT
											estados.id_estado,
											estados.dsc_estado
											FROM
											estados
											GROUP BY
											estados.clave
											ORDER BY
											estados.dsc_estado ASC");
    	 return ($query->num_rows() > 0)? $query->result_array() : NULL;
    }

}
?>