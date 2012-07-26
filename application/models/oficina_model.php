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
											tipo_oficina.nombre,
											oficina.nombre_oficina,
											oficina.rfc,
											oficina.estado,
											oficina.municipio,
											oficina.localidad,
											oficina.cp,
											oficina.direccion,
											oficina.lada,
											oficina.num_telefono,
											oficina.ext,
											oficina.fax,
											oficina.email,
											oficina.comentario,
											oficina.coordx,
											oficina.coordy
											FROM
											oficina ,
											tipo_oficina 
											WHERE
											oficina.tipo_oficina_id_tipo_oficina = tipo_oficina.id_tipo_oficina AND
											oficina.activo = 1 AND
											tipo_oficina.activo = 1										
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
											oficina,
											tipo_oficina 
											where
											oficina.tipo_oficina_id_tipo_oficina = tipo_oficina.id_tipo_oficina AND
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
											oficina.tipo_oficina_id_tipo_oficina,
											oficina.nombre_oficina,
											oficina.rfc,
											oficina.estado,
											oficina.municipio,
											oficina.localidad,
											oficina.cp,
											oficina.direccion,
											oficina.lada,
											oficina.num_telefono,
											oficina.ext,
											oficina.fax,
											oficina.email,
											oficina.comentario,
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
	   	'tipo_oficina_id_tipo_oficina'=>$this->input->post('tipo_oficina_id_tipo_oficina'),
	   	'nombre_oficina'=>$this->input->post('nombre_oficina'),
		'rfc'=>$this->input->post('rfc'),
		'estado'=>$this->input->post('estado'),
		'municipio'=>$this->input->post('municipio'),
		'localidad'=>$this->input->post('localidad'),
		'cp'=>$this->input->post('cp'),
		'direccion'=>$this->input->post('direccion'),
		'lada'=>$this->input->post('lada'),
		'num_telefono'=>$this->input->post('num_telefono'),
		'ext'=>$this->input->post('ext'),
		'fax'=>$this->input->post('fax'),
		'email'=>$this->input->post('email'),
		'comentario'=>$this->input->post('comentario'),
		// 'logo'=>$this->input->post('logo'),
		'coordx'=>$this->input->post('coordx'),
		'coordy'=>$this->input->post('coordy')
	);

	$this->db->where('id_oficina', $id);
	$this->db->update('oficina',$data);
   }

    public function guardar()
   {
   			$data = array (
							'tipo_oficina_id_tipo_oficina'=>$this->input->post('tipo_oficina_id_tipo_oficina'),
						   	'nombre_oficina'=>$this->input->post('nombre_oficina'),
							'rfc'=>$this->input->post('rfc'),
							'estado'=>$this->input->post('estado'),
							'municipio'=>$this->input->post('municipio'),
							'localidad'=>$this->input->post('localidad'),
							'cp'=>$this->input->post('cp'),
							'direccion'=>$this->input->post('direccion'),
							'lada'=>$this->input->post('lada'),
							'num_telefono'=>$this->input->post('num_telefono'),
							'ext'=>$this->input->post('ext'),
							'fax'=>$this->input->post('fax'),
							'email'=>$this->input->post('email'),
							'comentario'=>$this->input->post('comentario'),
							// 'logo'=>$this->input->post('logo'),
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