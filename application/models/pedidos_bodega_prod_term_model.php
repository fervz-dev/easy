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
				'id_sucursal'=>$this->session->userdata('oficina'),
				'id_producto'=>$arrayProducto[0],
				);


		$this->db->insert('pedido_bodega_producto_terminado', $data);
		$idPedido=$this->db->insert_id();
		   			$Productos=array(	'id_pedido'=>$idPedido,
		   								'id_producto'=>$arrayProducto[0],
		   								'activo'=>1,
		   								'cantidad'=>$arrayProductoShow[0]
		   							);

		   			$this->db->insert('pedido_productos', $Productos);
		$idProductoPedido=$this->db->insert_id();

		   		for ($i=0; $i < count($arrayComponentes); $i++) {
		   			$Componentes=array(	'id_pedido_producto'=>$idPedido,
		   								'id_componente'=>$arrayComponentes[$i],
		   								'id_producto_pedido'=>$idProductoPedido,
		   								'cantidad'=>$arrayComponentesShow[$i],
		   								'id_producto'=>$arrayProducto[0],
		   								);

		   			$this->db->insert('componentes_producto', $Componentes);
		   		}
		   		if ($this->db->affected_rows()>0) {
		   			return 1;
		   		}else{
		   			return 0;
		   		}

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
										pedido_bodega_producto_terminado.cliente,
										pedido_bodega_producto_terminado.id_producto
										FROM
										pedido_bodega_producto_terminado
										WHERE
										pedido_bodega_producto_terminado.id_pedido = $id ");
        $fila = $query->row();
          return $fila;
    }
public function productosComponentes($idPedido)
{
	$productos= $this->db->query("	SELECT
								pedido_productos.id_pedido_producto,
								pedido_productos.id_producto,
								producto_final.nombre,
								pedido_productos.cantidad
								FROM
								pedido_productos ,
								producto_final
								WHERE
								pedido_productos.id_pedido = $idPedido AND
								pedido_productos.id_producto = producto_final.id_catalogo AND
								pedido_productos.activo = 1");
$resultProducto=$productos->result_array();


	$componentes = $this->db->query("SELECT
									componentes_producto.id_componentes_producto,
									catalogo_producto.nombre,
									componentes_producto.cantidad
									FROM
									pedido_productos ,
									componentes_producto ,
									catalogo_producto
									WHERE
									componentes_producto.id_producto_pedido = ".$resultProducto[0]['id_pedido_producto']."
									GROUP BY
									componentes_producto.id_componentes_producto");
	$resultComponentes=$componentes->result_array();
	$htmlComponente='';
    $htmlComponente='<table cellspacing="0" style="width: 300px;">
        <tr><th colspan="2"> <strong> PRODUCTOS  </strong></th></tr>
        <tr><th>Nombre</th><th>Cantidad</th></tr>';
        for ($i=0; $i < count($resultProducto); $i++) {
            $htmlComponente.='<tr>
                                <td>'.
                                    $resultProducto[$i]["nombre"].'
                                    <input type="hidden" name="inputHideProductos[]" id="inputHideProductos_'.$resultProducto[$i]["id_pedido_producto"].'" value="'.$resultProducto[$i]["id_pedido_producto"].'"/>
                                </td>';

        $htmlComponente.='<td>
                                <input type="text" name="inputShowProductos[]" id="inputShowProductos_'.$resultProducto[$i]["id_pedido_producto"].'" value="'.$resultProducto[$i]["cantidad"].'"/>
                            </td>
                        </tr>';
        }

    $htmlComponente.='<tr><th colspan="2" ><strong> COMPONENTES </strong></th></tr>';

    for ($i=0; $i < count($resultComponentes); $i++) {
        $htmlComponente.='<tr>
                            <td>'.
        $resultComponentes[$i]["nombre"].'
         <input type="hidden" name="inputHideComponentes[]" id="inputHideComponentes[]" value="'.$resultComponentes[$i]["id_componentes_producto"].'"/>
                            </td>';

        $htmlComponente.='<td>
                                <input type="text" name="inputShowComponentes[]" id="inputShowComponentes_'.$resultComponentes[$i]["id_componentes_producto"].'" value="'.$resultComponentes[$i]["cantidad"].'"/>
                            </td>
                        </tr>';
}
        $htmlComponente.='</table>';
        return $htmlComponente;

}
   public function editar($id)
   {
	$arrayProducto=$this->input->post('arrayProductos');
	$arrayProductoShow=$this->input->post('arrayProductosShow');

	$arrayComponentes=$this->input->post('arrayComponentes');
	$arrayComponentesShow=$this->input->post('arrayComponentesShow');

	$data = array (
	'fecha_entrega'=>$this->input->post('fecha_entrega'),
	'cliente'=>$this->input->post('clientes'),
	'oficina_pedido'=>$this->input->post('oficina_pedido'),
	'id_usuario'=>$this->session->userdata('id'),
	'id_sucursal'=>$this->session->userdata('oficina'),
	);
		
		
		$this->db->where("id_pedido", $id);
		$this->db->update('pedido_bodega_producto_terminado', $data);

		$Productos=array('cantidad'=>$arrayProductoShow[0]);
		$this->db->where('id_pedido',$id);
		$this->db->where('id_pedido_producto',$arrayProducto[0]);
		$this->db->update('pedido_productos', $Productos);

	for ($i=0; $i < count($arrayComponentes); $i++) {
		$Componentes=array('cantidad'=>$arrayComponentesShow[$i]);
		$this->db->where('id_componentes_producto',$arrayComponentes[$i]);
		$this->db->update('componentes_producto', $Componentes);
	}

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