<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_naves_model extends CI_Model {


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
									WHERE stock_linea.id_sucursal =".$this->session->userdata('oficina')."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

}

/* End of file stock_naves_model.php */
/* Location: ./application/models/stock_naves_model.php */
