<?php
/**
*
*/
class Pedidos_reutilizable_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_pedido_proveedor_reutilizable($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									pedidos_reutilizable.id_pedido_reutilizable,
									pedidos_reutilizable.fecha_pedido,
									pedidos_reutilizable.fecha_entrega,
									pedidos_reutilizable.cantidad,
									proveedores.nombre_empresa,
									oficina.nombre_oficina,
									pedidos_reutilizable.activo
									FROM
									pedidos_reutilizable ,
									proveedores ,
									oficina
									WHERE
									pedidos_reutilizable.proveedores_id_proveedores = proveedores.id_proveedores
									AND
									pedidos_reutilizable.oficina = oficina.id_oficina
									AND
									pedidos_reutilizable.id_sucursal =".$this->session->userdata('oficina')."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}
///////////////////////////////////////////////////////funcion mysql para extraer los registros que cumplan con la condicion que esten cerrados////////////////////////////////////////////////////////////////
	public function get_pedido_proveedor_reutilizable_stock($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									pedidos_reutilizable.id_pedido_reutilizable,
									pedidos_reutilizable.fecha_pedido,
									pedidos_reutilizable.fecha_entrega,
									pedidos_reutilizable.cantidad,
									proveedores.nombre_empresa,
									oficina.nombre_oficina,
									pedidos_reutilizable.activo,
									pedidos_reutilizable.verificacion_almacen
									FROM
									pedidos_reutilizable ,
									proveedores ,
									oficina
									WHERE
									pedidos_reutilizable.proveedores_id_proveedores = proveedores.id_proveedores AND
									pedidos_reutilizable.oficina = oficina.id_oficina AND
									pedidos_reutilizable.activo = '0' AND
									pedidos_reutilizable.verificacion_almacen = '1' AND
									pedidos_reutilizable.oficina =".$this->session->userdata('oficina')."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}
	public function get_pedido_id($sidx, $sord, $start, $limite, $id)
	{
		$query = $this->db->query("SELECT
									cantidad_pedido.id_cantidad_pedido,
									cat_mprima.nombre,
									cat_mprima.ancho,
									cat_mprima.largo,
									cantidad_pedido.cantidad,
									resistencia_mprima.resistencia
									FROM
									cantidad_pedido ,
									cat_mprima ,
									resistencia_mprima
									WHERE
									cantidad_pedido.id_pedido = $id AND
									cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima AND
									cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
									resistencia_mprima.activo = 1
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}



    public function get_id($id)
    {
        $query = $this->db->query("SELECT
										pedidos_reutilizable.fecha_entrega,
										pedidos_reutilizable.proveedores_id_proveedores,
										pedidos_reutilizable.oficina,
										pedidos_reutilizable.cantidad
										FROM
										pedidos_reutilizable
										WHERE
										pedidos_reutilizable.id_pedido_reutilizable = $id");
        $fila = $query->row();
          return $fila;
    }

   public function editar($id)
   {
	   	$data = array (
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'proveedores_id_proveedores'=>$this->input->post('proveedor_id_proveedor'),
				'oficina'=>$this->input->post('oficina'),
				'cantidad'=>$this->input->post('cantidad'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina')

						);

	$this->db->where('id_pedido_reutilizable', $id);
	$this->db->update('pedidos_reutilizable',$data);
   }

   public function guardar()
   {
   		$data = array (
					   	'catalogo_producto'=>$this->input->post('catalogo_producto'),
						'cantidad'=>$this->input->post('cantidad'),
						'id_pedido'=>$this->input->post('id_pedido'),
						'id_usuario'=>$this->session->userdata('id'),
						'id_sucursal'=>$this->session->userdata('oficina')
						);
   		$this->db->insert('cantidad_pedido', $data);
		return $this->db->affected_rows();
   }

   public function eliminar_pedido($id)
   {


				$data = array('id_pedido_reutilizable' => $id);
				$this->db->delete('pedidos_reutilizable',$data);
				return $this->db->affected_rows();
   }

   public function eliminar_producto($id)
   {
	    $data = array('id_cantidad_pedido' => $id);
				$this->db->delete('cantidad_pedido',$data);
				return $this->db->affected_rows();
   }

public function guardar_pedido()
   {
		   		$data = array (
		   		'fecha_pedido'=>date("Y-m-d"),
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'proveedores_id_proveedores'=>$this->input->post('proveedor_id_proveedor'),
				'cantidad'=>$this->input->post('cantidad'),
				'oficina'=>$this->input->post('oficina'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina')
			);
   		$this->db->insert('pedidos_reutilizable', $data);
		return $this->db->affected_rows();
	}


/////////////////////cerrar pedido /////////////////////
public function cerrar($id)
{
    $data = array('activo' => 0);
			$this->db->where('id_pedido_reutilizable', $id);
			$this->db->update('pedidos_reutilizable', $data);
			return $this->db->affected_rows();
}
/////////////////////////enviar los datos del produto a pedidos provedor/bajar_stock_reutilizable//////////
	public function get_pedido_reutilizable($id)
	{
		$query = $this->db->query("SELECT
										proveedores.nombre_empresa,
										pedidos_reutilizable.cantidad
										FROM
										pedidos_reutilizable,
										proveedores
										WHERE
										pedidos_reutilizable.id_pedido_reutilizable = $id AND
										pedidos_reutilizable.proveedores_id_proveedores = proveedores.id_proveedores");
				$fila = $query->row();
				          return $fila;
	}
   }
?>