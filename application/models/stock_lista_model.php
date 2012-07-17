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

	public function add_stock($id)
	{

		$nom   =  $this->input->post('nombre');
		$anc   =  $this->input->post('ancho');
		$lar   =  $this->input->post('largo');
		$corrugado   =  $this->input->post('tipo_m');
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
				$cantidad_total=$cantidad_bd + $cant;
				
				$data = array ('cantidad'=>$cantidad_total);
				$this->db->where('id_stock_linea', $id_stock);
				$this->db->update('stock_linea',$data);
				$data_cantidad = array ('verificacion'=>1);
				$numero_rows=$this->db->affected_rows();
				if ($numero_rows>0) {
					// actualiza el registro de la tabla cantidad producto el campo verificacion a '1',
					// para mostrar en la grid que ya se a verificado y agregado correctamente
					$this->db->where('id_cantidad_pedido', $id);
					$this->db->update('cantidad_pedido',$data_cantidad);
					return $this->db->affected_rows();
				}
				

				
		}else{
			
			$data= array (
						'nombre'=>$this->input->post('nombre'),
						'ancho'=>$this->input->post('ancho'),
						'largo'=>$this->input->post('largo'),
						'corrugado'=>$this->input->post('tipo_m'),
						'resistencia'=>$this->input->post('resistencia'),
						'cantidad'=>$this->input->post('cantidad'),
						'fecha_ingreso'=>date('y-m-d')
						);

			$num_rows_insert=$this->db->insert('stock_linea', $data);
			if ($num_rows_insert>0) {
					// actualiza el registro de la tabla cantidad producto el campo verificacion a '1',
					// para mostrar en la grid que ya se a verificado y agregado correctamente
				$data_cantidad = array ('verificacion'=>1);
					$this->db->where('id_cantidad_pedido', $id);
					$this->db->update('cantidad_pedido',$data_cantidad);
				return $this->db->affected_rows();
			}
			 
		}

		
	}

	
   }
?>