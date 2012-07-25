<?php /**
* 
*/
class Proveedores_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_proveedores($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
										proveedores.id_proveedores,
										proveedores.nombre_contacto,
										proveedores.nombre_empresa,
										proveedores.estado,
										proveedores.municipio,
										proveedores.localidad,
										proveedores.cp,
										proveedores.direccion,
										proveedores.lada,
										proveedores.num_telefono,
										proveedores.ext,
										proveedores.fax,
										proveedores.email,
										proveedores.comentario
										FROM
										proveedores ,
										estados
										WHERE
										proveedores.activo = 1 
										ORDER BY $sidx $sord 
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

	public function get_proveedores_all()			
	{
		$query = $this->db->query("SELECT
											proveedores.id_proveedores,
											proveedores.nombre_empresa
											FROM
											proveedores
											WHERE
											proveedores.activo = 1
											GROUP BY
											proveedores.id_proveedores
											ORDER BY
											proveedores.nombre_empresa ASC");
		return ($query->num_rows() > 0)? $query->result_array() : NULL;
	}

    public function get_id($id)
    {
        $query = $this->db->query("SELECT
										proveedores.nombre_contacto,
										proveedores.nombre_empresa,
										proveedores.estado,
										proveedores.municipio,
										proveedores.localidad,
										proveedores.cp,
										proveedores.direccion,
										proveedores.lada,
										proveedores.num_telefono,
										proveedores.ext,
										proveedores.fax,
										proveedores.email,
										proveedores.comentario
										FROM
										proveedores
										WHERE
										proveedores.activo = 1 AND
										proveedores.id_proveedores = $id
										GROUP BY
										proveedores.id_proveedores
										ORDER BY
										proveedores.nombre_empresa ASC");
        $fila = $query->row();
          return $fila;    
    }

   public function editar($id)
   {
	   	$data = array (
	   	'nombre_contacto'=>$this->input->post('nombre_contacto'),
		'nombre_empresa'=>$this->input->post('nombre_empresa'),
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
		'comentario'=>$this->input->post('comentario')
	);

	$this->db->where('id_proveedores', $id);
	$this->db->update('proveedores',$data);
   }

   public function guardar()
   {
		   		$data = array (
			   	'nombre_contacto'=>$this->input->post('nombre_contacto'),
				'nombre_empresa'=>$this->input->post('nombre_empresa'),
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
				'activo'=>'1'
			);
   		$this->db->insert('proveedores', $data);
		return $this->db->affected_rows(); 
   }

   public function eliminar($id)
   {
	    $data = array('activo' => 0);
				$this->db->where('id_proveedores', $id);
				$this->db->update('proveedores', $data);
				return $this->db->affected_rows();
   }	
}
?>