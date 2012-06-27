<?php 
/**
* 
*/
class Stock_lista_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_stock_lista($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									stock_linea.id_stock_linea,
									stock_linea.nombre,
									stock_linea.ancho,
									stock_linea.largo,
									stock_linea.corrugado,
									stock_linea.resistencia,
									stock_linea.cantidad
									FROM
									stock_linea
									ORDER BY $sidx $sord 
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function add_stock()
	{

		$nom   =  $this->input->post('nombre');
		$anc   =  $this->input->post('ancho');
		$lar   =  $this->input->post('largo');
		$resis =  $this->input->post('resistencia');
		$cant  =  $this->input->post('cantidad');

		$query= $this->db->query("SELECT
										stock_linea.id_stock_linea,										stock_linea.nombre,
										stock_linea.ancho,
										stock_linea.largo,
										stock_linea.cantidad,
										stock_linea.resistencia
										FROM
										stock_linea
										WHERE
										stock_linea.nombre='".$nom."' AND
										stock_linea.ancho= '".$anc."' AND
										stock_linea.largo= '".$lar."' AND
										stock_linea.resistencia= '".$resis."'
										LIMIT 1");
	$respuesta=$query->row();
		if (count($respuesta)>0) {

				$id_stock=$respuesta->id_stock_linea;
				$cantidad_bd=$respuesta->cantidad;
				$cantidad_total=$cantidad + $cant;
				
			$this->db->where('id_stock_linea', $id_stock);
			$this->db->update('clientes',$cantidad_total);
			return $this->db->affected_rows();
		}else{
			$data= array (
						'nombre'=>$this->input->post('nombre'),
						'ancho'=>$this->input->post('ancho'),
						'largo'=>$this->input->post('largo'),
						'resistencia'=>$this->input->post('resistencia'),
						'cantidad'=>$this->input->post('cantidad'),
						'fecha_ingreso'=>date('y-m-d')
		);
		$this->db->insert('stock_linea', $data);
		return $this->db->affected_rows(); 
		}

		
	}

	
   }
?>