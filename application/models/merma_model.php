<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Merma_model extends CI_Model {
	public function get_merma($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
			merma.id_merma,
merma.cantidad,
merma.fecha_venta,
clientes.nombre_empresa,
oficina.nombre_oficina
FROM
clientes ,
merma ,
oficina
WHERE
merma.oficina_id_oficina = oficina.id_oficina AND
merma.id_cliente = clientes.id_clientes
GROUP BY
merma.id_merma  ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

   public function guardar()
   {
		   			$data = array (
		   				'oficina_id_oficina'=>$this->input->post('oficina'),
						'cantidad'=>$this->input->post('cantidad'),
						'fecha_venta'=>$this->input->post('fecha_venta'),
						'id_cliente'=>$this->input->post('clientes'),
        				'id_usuario'=>$this->session->userdata('id'),
        				'id_sucursal'=>$this->session->userdata('oficina')
						);
   		$this->db->insert('merma', $data);
		return $this->db->affected_rows();
   }

}

/* End of file merma_model.php */
/* Location: ./application/models/merma_model.php */
