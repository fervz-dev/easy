<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Componentes_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function getComponentesId($idProducto, $idCliente)
	{
		$query=$this->db->query("SELECT
									catalogo_producto.id_catalogo,
									catalogo_producto.nombre
									FROM
									catalogo_producto
									WHERE
									catalogo_producto.activo = 1 AND
									catalogo_producto.id_productoFinal = $idProducto AND
									catalogo_producto.id_cliente = $idCliente");
		return ($query->num_rows()>0)? $query->result_array() :NULL;
	}

}

/* End of file componentes_model.php */
/* Location: ./application/models/componentes_model.php */
