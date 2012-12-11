<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_bodega_prod_term_model extends CI_Model {

public function get_pedido_bodega_producto($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
										pedido_bodega_producto_terminado.id_pedido,
										pedido_bodega_producto_terminado.fecha_pedido,
										pedido_bodega_producto_terminado.fecha_entrega,
										oficina.nombre_oficina,
										clientes.nombre_empresa,
										pedido_bodega_producto_terminado.activo,
										pedido_bodega_producto_terminado.verificacion_almacen,
										producto_final.nombre
										FROM
										pedido_bodega_producto_terminado ,
										oficina,
										clientes,
										producto_final
										WHERE
										producto_final.id_catalogo=pedido_bodega_producto_terminado.id_producto ANd
										pedido_bodega_producto_terminado.oficina_pedido = oficina.id_oficina AND
										clientes.id_clientes = pedido_bodega_producto_terminado.cliente
										ORDER BY $sidx $sord
										LIMIT $start, $limite;"
								);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function guardar_pedido()
   {
		   		$arrayProducto=$this->input->post('arrayProductos');
		   		$arrayProductoShow=$this->input->post('arrayProductosShow');

		   		$arrayComponentes=$this->input->post('arrayComponentes');
		   		$arrayComponentesShow=$this->input->post('arrayComponentesShow');

		   		$data = array (
		   		'fecha_pedido'=>date("Y-m-d"),
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'cliente'=>$this->input->post('clientes'),
				'oficina_pedido'=>$this->input->post('oficina_pedido'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina'));


		$this->db->insert('pedido_bodega_producto_terminado', $data);
		$idPedido=$this->db->insert_id();
		   			$Productos=array(	'id_pedido'=>$idPedido,
		   								'id_producto'=>$arrayProducto[0],
		   								'activo'=>1,
		   								'cantidad'=>$arrayProductoShow[0]
		   							);

		   			$this->db->insert('pedido_productos', $Productos);
				

		   		for ($i=0; $i < count($arrayComponentes); $i++) { 
		   			$Componentes=array(	'id_pedido_producto'=>$idPedido,
		   								'id_componente'=>$arrayComponentes[$i], 
		   								'id_pedido_producto'=>$arrayProducto[0],
		   								'cantidad'=>$arrayComponentesShow[$i]
		   								);

		   			$this->db->insert('componentes_producto', $Componentes);
		   		}

		return $this->db->affected_rows();
	}

public function guardar()
   {
   		$data = array (
					   	'catalogo_producto'=>$this->input->post('catalogo_producto'),
						'cantidad'=>$this->input->post('cantidad'),
						'observaciones'=>$this->input->post('observaciones_bodega_pedido'),
						'id_pedido'=>$this->input->post('id_pedido'),
        				'id_usuario'=>$this->session->userdata('id'),
        				'id_sucursal'=>$this->session->userdata('oficina'),
        				'id_bodega_hacer'=>$this->input->post('oficina_pedido_hacer'),
        				'fecha_entrega'=>$this->input->post('fecha_entrega_pedido')
						);
   		$this->db->insert('cantidad_pedido_producto', $data);
		return $this->db->affected_rows();
   }

   public function get_id($id)
    {
        $query = $this->db->query("SELECT
        								pedido_bodega_producto_terminado.fecha_entrega,
										pedido_bodega_producto_terminado.oficina_pedido,
										pedido_bodega_producto_terminado.cliente
										FROM
										pedido_bodega_producto_terminado
										WHERE
										pedido_bodega_producto_terminado.id_pedido = $id ");
        $fila = $query->row();
          return $fila;
    }

   public function editar($id)
   {
	   	$data = array (
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'cliente'=>$this->input->post('clientes'),
				'oficina_pedido'=>$this->input->post('oficina_pedido'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina')
						);

	$this->db->where('id_pedido', $id);
	$this->db->update('pedido_bodega_producto_terminado',$data);
   }

      public function eliminar_producto($id)
   {
	    $data = array('id_cantidad_pedido' => $id);
				$this->db->delete('cantidad_pedido_producto',$data);
				return $this->db->affected_rows();
   }
	/////////////////////cerrar pedido /////////////////////
	public function cerrar($id)
	{
	    $data = array('activo' => 0);
				$this->db->where('id_pedido', $id);
				$this->db->update('pedido_bodega_producto_terminado', $data);
				return $this->db->affected_rows();
	}

		/////////////////////cerrar pedido /////////////////////
	public function terminar_pedido($id)
	{
	    $data = array('verificacion_almacen' => 0);

				$this->db->where('id_pedido', $id);
				$this->db->update('pedido_bodega_producto_terminado', $data);
				return $this->db->affected_rows();
	}

		/////////////////////cerrar pedido /////////////////////
	public function terminar_producto($id)
	{
	    $data = array('verificacion' => 0);
	    		$this->db->where('validacion_bodega_hacer', 1);
				$this->db->where('id_cantidad_pedido', $id);
				$this->db->update('cantidad_pedido_producto', $data);
				return $this->db->affected_rows();
	}
}

/* End of file pedidos_bodega_prod_term_model.php */
/* Location: ./application/controllers/pedidos_bodega_prod_term_model.php */