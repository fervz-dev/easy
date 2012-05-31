<?php 
/**
* 
*/
class Directorio_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_directorio($sidx, $sord, $start, $limite, $id)
	{
		$query = $this->db->query("SELECT
										direcciones.id_direcciones,
										estados.dsc_estado,
										direcciones.direccion,
										direcciones.colonia,
										direcciones.ciudad,
										direcciones.observaciones
										FROM
										direcciones ,
										estados
										WHERE
										direcciones.clientes_id_clientes = $id AND
										estados.id_estado = direcciones.estado_id_estado
									ORDER BY $sidx $sord 
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

    public function get_id($id)
    {
        $query = $this->db->query("SELECT
        								direcciones.id_direcciones,
										direcciones.estado_id_estado,
										direcciones.direccion,
										direcciones.colonia,
										direcciones.ciudad,
										direcciones.observaciones
										FROM
										direcciones
										WHERE
										direcciones.activo = 1 AND
										direcciones.id_direcciones = $id
											");
				        $fila = $query->row();
				          return $fila;    
	}

   public function editar()
   {
	   	$data = array (
		'estado_id_estado'=>$this->input->post('estado_id_estado_d'),
		'direccion'=>$this->input->post('direccion_d'),
		'colonia'=>$this->input->post('colonia_d'),
		'ciudad'=>$this->input->post('ciudad_d'),
		'observaciones'=>$this->input->post('observaciones_d')
	);
	$id=$this->input->post('id_direcciones');

	$this->db->where('id_direcciones', $id);
	$this->db->update('direcciones',$data);
   }

   public function guardar()
   {
		   			$data = array (
		   							'clientes_id_clientes'=>$this->input->post('clientes_id_clientes'),
									'estado_id_estado'=>$this->input->post('estado_id_estado_d'),
									'direccion'=>$this->input->post('direccion_d'),
									'colonia'=>$this->input->post('colonia_d'),
									'ciudad'=>$this->input->post('ciudad_d'),
									'observaciones'=>$this->input->post('observaciones_d'),
									'activo'=>1
									);
   		$this->db->insert('direcciones', $data);
		return $this->db->affected_rows(); 
   }

   public function eliminar($id)
   {
	    $data = array('activo' => 0);
				$this->db->where('id_clientes', $id);
				$this->db->update('clientes', $data);
				return $this->db->affected_rows();
   }

   public function comparar($id)
    {
        $query = $this->db->query("SELECT direcciones.clientes_id_clientes
											FROM
											direcciones
											WHERE
											direcciones.id_direcciones = $id
											");
				        $fila = $query->row();
				          return $fila;    
	}
}
?>