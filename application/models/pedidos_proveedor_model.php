<?php 
/**
* 
*/
class Pedidos_proveedor_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_pedido_proveedor($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									pedido_proveedor.id_pedido,
									pedido_proveedor.fecha_pedido,
									pedido_proveedor.fecha_entrega,
									proveedores.nombre_empresa,
									oficina.nombre_oficina,
									pedido_proveedor.activo									
									FROM
									pedido_proveedor ,
									proveedores ,
									oficina
									WHERE
									pedido_proveedor.proveedores_id_proveedores = proveedores.id_proveedores 
									AND
									pedido_proveedor.oficina = oficina.id_oficina
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
        								pedido_proveedor.fecha_entrega,
										pedido_proveedor.proveedores_id_proveedores,
										pedido_proveedor.oficina
										FROM
										pedido_proveedor
										WHERE
										pedido_proveedor.id_pedido = $id");
        $fila = $query->row();
          return $fila;    
    }

   public function editar($id)
   {
	   	$data = array (
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'proveedores_id_proveedores'=>$this->input->post('proveedor_id_proveedor'),
				'oficina'=>$this->input->post('oficina')
						);

	$this->db->where('id_pedido', $id);
	$this->db->update('pedido_proveedor',$data);
   }

   public function guardar()
   {
   		$data = array (
					   	'catalogo_producto'=>$this->input->post('catalogo_producto'),
						'cantidad'=>$this->input->post('cantidad'),
						'id_pedido'=>$this->input->post('id_pedido'),
						);
   		$this->db->insert('cantidad_pedido', $data);
		return $this->db->affected_rows(); 
   }

   public function eliminar_pedido($id)
   {

				$this->db->trans_start();
				$data = array('id_pedido' => $id);
				$this->db->delete('cantidad_pedido',$data);
				$data = array('id_pedido' => $id);
				$this->db->delete('pedido_proveedor',$data);
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
				$this->db->delete('cantidad_pedido',$data);
				return $this->db->affected_rows();
   }

public function guardar_pedido()
   {
		   		$data = array (
		   		'fecha_pedido'=>date("Y-m-d"),
			   	'fecha_entrega'=>$this->input->post('fecha_entrega'),
				'proveedores_id_proveedores'=>$this->input->post('proveedor_id_proveedor'),
				'oficina'=>$this->input->post('oficina'),
				
			);
   		$this->db->insert('pedido_proveedor', $data);
		return $this->db->affected_rows(); 
	}
/////////////////////cerrar pedido /////////////////////
public function cerrar($id)
{
    $data = array('activo' => 0);
			$this->db->where('id_pedido', $id);
			$this->db->update('pedido_proveedor', $data);
			return $this->db->affected_rows();
}


//////////////////// extra solo los campos que cumplan con la condicion si activo=1 /////////////////////////////////////
public function get_pedido_proveedor_almacen($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									pedido_proveedor.id_pedido,
									pedido_proveedor.fecha_pedido,
									pedido_proveedor.fecha_entrega,
									proveedores.nombre_empresa,
									oficina.nombre_oficina,
									pedido_proveedor.activo,
									pedido_proveedor.verificacion_almacen								
									FROM
									pedido_proveedor ,
									proveedores ,
									oficina
									WHERE
									pedido_proveedor.proveedores_id_proveedores = proveedores.id_proveedores 
									AND
									pedido_proveedor.oficina = oficina.id_oficina
									AND
									pedido_proveedor.activo=0
									ORDER BY $sidx $sord 
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function verificacion_model($id)
	{
			$data = array ('verificacion_almacen'=>0);

	$this->db->where('id_pedido', $id);
	$this->db->update('pedido_proveedor',$data);
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
				resistencia_mprima.resistencia,
				cantidad_pedido.cantidad				
				FROM
				cantidad_pedido ,
				cat_mprima ,
				resistencia_mprima
				WHERE
				cantidad_pedido.id_cantidad_pedido = $id AND
				cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima AND
				cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
				resistencia_mprima.activo = 1");
				$fila = $query->row();
				          return $fila; 		
	}

   }
?>