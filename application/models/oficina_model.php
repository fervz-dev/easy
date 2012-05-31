<?php 
/**
* 
*/
class Oficina_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_oficina($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
											oficina.id_oficina,
											oficina.nombre_oficina,
											tipo_oficina.nombre,
											oficina.direccion,
											oficina.colonia,
											oficina.telefono,
											oficina.rfc,
											oficina.observaciones,
											oficina.ciudad,
											estados.dsc_estado,
											oficina.cp
											FROM
											oficina ,
											tipo_oficina ,
											estados
											WHERE
											oficina.tipo_oficina_id_tipo_oficina = tipo_oficina.id_tipo_oficina AND
											oficina.activo = 1 AND
											tipo_oficina.activo = 1 AND

											oficina.tipo_oficina_id_tipo_oficina = tipo_oficina.id_tipo_oficina AND
											oficina.estado_id_estado = estados.clave
											ORDER BY $sidx $sord 
											LIMIT $start, $limite;"
											);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}
	public function get_oficinas_all()
	{
		$query = $this->db->query("SELECT
											oficina.id_oficina,
											oficina.nombre_oficina
											FROM
											oficina
											where
											oficina.tipo_oficina_id_tipo_oficina = 2
											GROUP BY
											oficina.id_oficina
											ORDER BY
											oficina.nombre_oficina ASC");
		return ($query->num_rows() > 0)? $query->result_array() : NULL;
			
	}

	public function get_id($id)
    {
        $query = $this->db->query("SELECT
										oficina.nombre_oficina,
										oficina.tipo_oficina_id_tipo_oficina,
										oficina.direccion,
										oficina.colonia,
										oficina.telefono,
										oficina.rfc,
										oficina.ciudad,
										oficina.estado_id_estado,
										oficina.cp,
										oficina.logo,
										oficina.observaciones,
										oficina.coordx,
										oficina.coordy
										FROM
										oficina
										WHERE
										oficina.id_oficina = $id AND
										oficina.activo = 1");
        $fila = $query->row();
          return $fila;    
    }

    public function editar($id)
   {
	   	$data = array (
	   	'nombre_oficina'=>$this->input->post('nombre_oficina'),
		'tipo_oficina_id_tipo_oficina'=>$this->input->post('tipo_oficina_id_tipo_oficina'),
		'direccion'=>$this->input->post('direccion'),
		'colonia'=>$this->input->post('colonia'),
		'telefono'=>$this->input->post('telefono'),
		'rfc'=>$this->input->post('rfc'),
		'ciudad'=>$this->input->post('ciudad'),
		'estado_id_estado'=>$this->input->post('estado_id_estado'),
		'cp'=>$this->input->post('cp'),
		'logo'=>$this->input->post('logo'),
		'observaciones'=>$this->input->post('observaciones'),
		'coordx'=>$this->input->post('coordx'),
		'coordy'=>$this->input->post('coordy')
	);

	$this->db->where('id_oficina', $id);
	$this->db->update('oficina',$data);
   }

    public function guardar()
   {
   			$data = array (
						   	'nombre_oficina'=>$this->input->post('nombre_oficina'),
							'tipo_oficina_id_tipo_oficina'=>$this->input->post('tipo_oficina_id_tipo_oficina'),
							'direccion'=>$this->input->post('direccion'),
							'colonia'=>$this->input->post('colonia'),
							'telefono'=>$this->input->post('telefono'),
							'rfc'=>$this->input->post('rfc'),
							'ciudad'=>$this->input->post('ciudad'),
							'estado_id_estado'=>$this->input->post('estado_id_estado'),
							'cp'=>$this->input->post('cp'),
							'logo'=>$this->input->post('logo'),
							'observaciones'=>$this->input->post('observaciones'),
							'coordx'=>$this->input->post('coordx'),
							'coordy'=>$this->input->post('coordy'),
							'activo'=>1
						 );
   		$this->db->insert('oficina', $data);
		return $this->db->affected_rows(); 
   }

   public function eliminar($id)
   {
	    $data = array('activo' => 0);
				$this->db->where('id_oficina', $id);
				$this->db->update('oficina', $data);
				return $this->db->affected_rows();
   }

   public function get()
   {
   		$query = $this->db->query("SELECT *	FROM oficina WHERE activo = 1 order by id_oficina");
   		return ($query->num_rows() > 0)? $query->result_array(): NULL;
   }

}
?>