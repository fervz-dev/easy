<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Historial_linea_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

public function guardar_select()
{



		$cantidad=$this->input->post('cantidad');
		$id_linea=$this->input->post('id_linea');
		$id_producto_post=$this->input->post('id_producto');


		$material=$this->db->query("SELECT
									stock_linea.nombre,
									stock_linea.corrugado,
									stock_linea.largo,
									stock_linea.ancho,
									stock_linea.resistencia,
									stock_linea.cantidad
									FROM
									stock_linea
									WHERE
									stock_linea.id_stock_linea=$id_linea");

		$resultado=$material->row();
	if (count($resultado)>0) {

		$cantidad_sistema=$resultado->cantidad;
		if ($cantidad>$cantidad_sistema) {
			return 4;
		}elseif (count($resultado)>0) {





		$data=array (
			'nombre'=>$resultado->nombre,
			'corrugado'=>$resultado->corrugado,
	        'largo'=>$resultado->largo,
	        'ancho'=>$resultado->ancho,
	        'resistencia'=>$resultado->resistencia,
	        'cantidad'=>$cantidad,
	        'fecha_uso'=>date('y-m-d'),
	        'id_usuario'=>$this->session->userdata('id'),
	        'id_sucursal'=>$this->session->userdata('oficina'),
	        'id_producto_uso_material'=>$id_producto_post,

			);

        $this->db->insert('historial_linea', $data);
         $numero_rows1=$this->db->affected_rows();
        if ($numero_rows1>0) {
				$cantidad_db=$resultado->cantidad;
				$result=$cantidad_db-$cantidad;
				$data2= array ('cantidad'=>$result);
           	 	$this->db->where('id_stock_linea',$id_linea);
        	    $this->db->update('stock_linea',$data2);
        	    return 1;
		}else{
			return 2;
		}
	}

	}else{
		return 0;
	}

}



}

/* End of file historial_reutilizable_model.php */
/* Location: ./application/models/historial_reutilizable_model.php */
