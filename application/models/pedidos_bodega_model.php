<?php
/**
*
*/
class Pedidos_bodega_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_pedido_bodega($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
										pedido_bodega.id_pedido,
										pedido_bodega.fecha_pedido,
										pedido_bodega.fecha_entrega,
										oficina_pedido.nombre_oficina AS oficina_pedido,
										oficina_envio.nombre_oficina AS oficina_envio,
										pedido_bodega.activo
										FROM
										pedido_bodega ,
										oficina AS oficina_pedido ,
										oficina AS oficina_envio
										WHERE
										pedido_bodega.oficina_pedido = oficina_pedido.id_oficina AND
										pedido_bodega.oficina = oficina_envio.id_oficina


									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}


	public function get_pedido_bodegaNave($sidx, $sord, $start, $limite)
	{
		$oficina=$this->session->userdata('oficina');
		$query = $this->db->query("SELECT
										pedido_bodega.id_pedido,
										pedido_bodega.fecha_pedido,
										pedido_bodega.fecha_entrega,
										oficina_pedido.nombre_oficina AS oficina_pedido,
										oficina_envio.nombre_oficina AS oficina_envio,
										pedido_bodega.activo,
										pedido_bodega.enviado
										FROM
										pedido_bodega ,
										oficina AS oficina_pedido ,
										oficina AS oficina_envio
										WHERE
										pedido_bodega.oficina_pedido = oficina_pedido.id_oficina AND
										pedido_bodega.oficina = oficina_envio.id_oficina AND
									    oficina_pedido.id_oficina= $oficina AND
										oficina_envio.activo=1 AND pedido_bodega.enviado=0

									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function get_pedido_id($sidx, $sord, $start, $limite, $id)
	{
		$query = $this->db->query("SELECT
									cantidad_pedido_bodega.cantidad_pedido_bodega,
									cat_mprima.nombre,
									cat_mprima.ancho,
									cat_mprima.largo,
									cantidad_pedido_bodega.cantidad,
									resistencia_mprima.resistencia
									FROM
									cantidad_pedido_bodega ,
									cat_mprima ,
									resistencia_mprima
									WHERE
									cantidad_pedido_bodega.id_pedido = $id AND
									cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima AND
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
        								pedido_bodega.fecha_entrega,
										pedido_bodega.oficina_pedido,
										pedido_bodega.oficina
										FROM
										pedido_bodega
										WHERE
										pedido_bodega.id_pedido = $id");
        $fila = $query->row();
          return $fila;
    }

   public function editar($id)
   {
	   	$data = array (
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'oficina_pedido'=>$this->input->post('oficina_pedido'),
				'oficina'=>$this->input->post('oficina'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina')
						);

	$this->db->where('id_pedido', $id);
	$this->db->update('pedido_bodega',$data);
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
   		$this->db->insert('cantidad_pedido_bodega', $data);
		return $this->db->affected_rows();
   }

   public function eliminar_pedido($id)
   {

		$this->db->trans_start();

		$data = array('id_pedido' => $id);
		$this->db->delete('cantidad_pedido_bodega',$data);
		$data = array('id_pedido' => $id);
		$this->db->delete('pedido_bodega',$data);

		$this->db->trans_complete();

		if ($this->db->trans_status()===FALSE) {
			return 0;
		}else{
			return 1;
		}



   }

   public function eliminar_producto($id)
   {
	    $data = array('id_cantidad_pedido' => $id);
				$this->db->delete('cantidad_pedido_bodega',$data);
				return $this->db->affected_rows();
   }

public function guardar_pedido()
   {
		   		$data = array (
		   		'fecha_pedido'=>date("Y-m-d"),
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'oficina_pedido'=>$this->input->post('oficina_pedido'),
				'oficina'=>$this->input->post('oficina'),
				'id_usuario'=>$this->session->userdata('id'),
				'id_sucursal'=>$this->session->userdata('oficina')

			);
   		$this->db->insert('pedido_bodega', $data);
		return $this->db->affected_rows();
	}
/////////////////////cerrar pedido /////////////////////
public function cerrar($id)
{
    $data = array('activo' => 0);
			$this->db->where('id_pedido', $id);
			$this->db->update('pedido_bodega', $data);
			return $this->db->affected_rows();
}

/////////////////////cerrar pedido /////////////////////
public function enviado($id)
{
    $data = array('enviado' => 1);
			$this->db->where('id_pedido', $id);
			$this->db->update('pedido_bodega', $data);
			return $this->db->affected_rows();
}

//////////////////// extra solo los campos que cumplan con la condicion si activo=1 /////////////////////////////////////
public function get_pedido_bodega_almacen($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									pedido_bodega.id_pedido,
									pedido_bodega.fecha_pedido,
									pedido_bodega.fecha_entrega,
									oficina_pedido.nombre_oficina AS oficina_pedido,
									oficina_envio.nombre_oficina AS oficina_envio,
									pedido_bodega.activo,
									pedido_bodega.verificacion_almacen
									FROM
										pedido_bodega ,
										oficina AS oficina_pedido ,
										oficina AS oficina_envio
								WHERE
									pedido_bodega.oficina_pedido = oficina_pedido.id_oficina
									AND
									pedido_bodega.oficina = oficina_envio.id_oficina
									AND
									pedido_bodega.activo=0
									AND pedido_bodega.oficina =".$this->session->userdata('oficina')."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"



									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function verificacion_model($id)
	{
			$data = array ('verificacion_almacen'=>0);

	$this->db->where('id_pedido', $id);
	$this->db->update('pedido_bodega',$data);
	return $this->db->affected_rows();

	}
	/////////////////////////enviar los datos del produto a pedidos provedor/bajar_stock_liena///////////
	public function get_producto_($id)
	{
		$query = $this->db->query("SELECT
				cat_mprima.nombre,
				cat_mprima.ancho,
				cat_mprima.largo,
				cat_mprima.tipo_m,
				resistencia_mprima.resistencia
				FROM
				cat_mprima,
				resistencia_mprima
				WHERE
				cat_mprima.id_cat_mprima = $id AND
				cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
				resistencia_mprima.activo = 1");
				$fila = $query->row();
				          return $fila;
	}

   }
?>