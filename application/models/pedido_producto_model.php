<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedido_producto_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getLista($id, $sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
										pedido_productos.id_pedido_producto,
										pedido_productos.cantidad,
										pedido_productos.id_pedido,
										pedido_productos.id_producto,
										pedido_productos.cantidad,
										producto_final.nombre,
										producto_final.largo,
										producto_final.ancho,
										producto_final.alto,
										resistencia_mprima.resistencia,
										producto_final.corrugado,
										producto_final.score,
										producto_final.descripcion
										FROM
										pedido_productos,
										producto_final ,
										resistencia_mprima
										WHERE
										pedido_productos.activo = 1 AND
										pedido_productos.id_pedido = $id AND
										producto_final.activo = 1 AND
										producto_final.id_catalogo=pedido_productos.id_producto AND
										producto_final.resistencia = resistencia_mprima.id_resistencia_mprima
										ORDER BY $sidx $sord
										LIMIT $start, $limite;");

		return ($query->num_rows()>0)? $query->result():NULL;
	}

	public function getComponentesXProducto($sidx, $sord, $start, $limite,$id)
	{
		$query = $this->db->query("SELECT
											componentes_producto.id_componentes_producto,
											componentes_producto.cantidad,
											catalogo_producto.nombre,
											catalogo_producto.largo,
											catalogo_producto.ancho,
											catalogo_producto.alto,
											resistencia_mprima.resistencia,
											catalogo_producto.corrugado,
											catalogo_producto.score,
											catalogo_producto.descripcion
								FROM
											componentes_producto,
											catalogo_producto,
											resistencia_mprima
								WHERE
								componentes_producto.id_producto_pedido = $id AND
								catalogo_producto.activo = 1 AND
								catalogo_producto.id_catalogo=componentes_producto.id_componente AND
								catalogo_producto.resistencia = resistencia_mprima.id_resistencia_mprima
										ORDER BY $sidx $sord
										LIMIT $start, $limite;");

		return ($query->num_rows()>0)? $query->result():NULL;
	}

	public function guardarListArray($id)
	{
		$arrayResult=$this->input->post('arrayRows');
		// var_dump($arrayRows);
		// echo "******";
		// $arrayResult=explode(',',$arrayRows);
		for ($i=0; $i < count($arrayResult); $i++) {
			$arrayComponentes = $this->db->query("SELECT
									catalogo_producto.id_catalogo
										FROM
										catalogo_producto
										WHERE
										catalogo_producto.activo = 1 AND
										catalogo_producto.id_productoFinal = $arrayResult[$i]
								");

			 $resultComponentes=$arrayComponentes->result_array();
			 // var_dump($resultComponentes);
			    $data1=array('id_pedido'=>$id,'id_producto'=>$arrayResult[$i],'activo'=>1);
				$this->db->insert('pedido_productos',$data1);
				$ultimo_id=$this->db->insert_id();
			for ($x=0; $x < count($resultComponentes); $x++) {
				$data= array('id_pedido_producto'=>$id,'id_componente'=>$resultComponentes[$x]['id_catalogo'],'id_producto_pedido'=>$ultimo_id,'id_producto'=>$arrayResult[$i],'activo'=>1);
				$this->db->insert('componentes_producto',$data);
			}

		}
		return 1;
	}
public function eliminarPorductoPedido($id)
{
	$this->db->trans_start();
		$data = array('id_pedido_producto' => $id);

		$this->db->delete('pedido_productos',$data);

		$componentes = array('id_producto_pedido' =>  $id);
		$this->db->delete('componentes_producto',$componentes);
	$this->db->trans_complete();
	if ($this->db->trans_status()===FALSE) {
		return 0;
	}else{
		return 1;
	}
}

public function guardarCantidadProducto($id)
{

	$data = array('cantidad' =>$this->input->post('cantidad'));
	$this->db->where('id_pedido_producto',$id);
	$this->db->update('pedido_productos',$data);
	return $this->db->affected_rows();
}


public function guardarCantidadComponente($id)
{

	$data = array('cantidad' =>$this->input->post('cantidad'));
	$this->db->where('id_componentes_producto',$id);
	$this->db->update('componentes_producto',$data);
	return $this->db->affected_rows();
}
}
/* End of file pedido_producto_model.php */
/* Location: ./application/models/pedido_producto_model.php */
