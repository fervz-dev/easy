<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_hacer_model extends CI_Model {
	public function __construct()
	{
	   parent::__construct();
	   //Do your magic here
	}
	public function get_pedido_hacer($sidx, $sord, $start, $limite)
	{
		    $oficina=$this->session->userdata('oficina');
		$query = $this->db->query("SELECT
										pedido_bodega_producto_terminado.id_pedido,
										pedido_bodega_producto_terminado.fecha_pedido,
										cantidad_pedido_producto.fecha_entrega,
										oficina.nombre_oficina,
										pedido_bodega_producto_terminado.finalizado__pedido_bodega
										FROM
										cantidad_pedido_producto ,
										pedido_bodega_producto_terminado ,
										catalogo_producto ,
										archivo,
										oficina
										WHERE
										cantidad_pedido_producto.id_bodega_hacer = $oficina AND
										cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo AND
										cantidad_pedido_producto.id_pedido = pedido_bodega_producto_terminado.id_pedido AND
										cantidad_pedido_producto.verificacion = 1 AND
										cantidad_pedido_producto.validacion_bodega_hacer = 0 AND
										pedido_bodega_producto_terminado.activo = 0 AND
										pedido_bodega_producto_terminado.finalizado__pedido_bodega = 0 AND
										pedido_bodega_producto_terminado.verificacion_almacen = 1
										GROUP BY
										pedido_bodega_producto_terminado.id_pedido
										ORDER BY $sidx $sord
										LIMIT $start, $limite;");

		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function cerrar_producto($id)
	{
	    $data = array('validacion_bodega_hacer' => 1);
				$this->db->where('id_cantidad_pedido', $id);
				$this->db->update('cantidad_pedido_producto', $data);
				return $this->db->affected_rows();
	}
}

/* End of file pedidos_hacer_model.php */
/* Location: ./application/models/pedidos_hacer_model.php */
