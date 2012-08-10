<?php
/**
*
*/
class Empleados_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function get_empleado($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT 	ob.id_obrero,
											ob.nombre_obrero,
											ob.a_paterno,
											ob.a_materno,
											ob.fecha_nacimiento,
											ob.estado_civil,
											ob.sexo,
											ob.estado,
											ob.municipio,
											ob.localidad,
											ob.cp,
											ob.direccion,
											ob.lada,
											ob.num_telefono,
											ob.celular,
											ob.email,
											pt.nombre,
											ofn.nombre_oficina,
											ob.comentario,
											ob.fecha_ingreso
									FROM obrero ob, puestos pt, oficina ofn
									WHERE ob.puestos_id_tipo_puesto = pt.id_tipo_puesto
									AND ob.oficina_id_oficina = ofn.id_oficina
									AND ob.activo = 1
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

    public function get_id($id)
    {
        $query = $this->db->query("SELECT
										obrero.nombre_obrero,
										obrero.a_paterno,
										obrero.a_materno,
										obrero.fecha_nacimiento,
										obrero.estado_civil,
										obrero.sexo,
										obrero.estado,
										obrero.municipio,
										obrero.localidad,
										obrero.cp,
										obrero.direccion,
										obrero.lada,
										obrero.celular,
										obrero.num_telefono,
										obrero.email,
										obrero.puestos_id_tipo_puesto,
										obrero.oficina_id_oficina,
										obrero.comentario,
										obrero.fecha_ingreso
										FROM
										obrero
										WHERE
										obrero.id_obrero = $id
										AND	obrero.activo = 1");
        $fila = $query->row();
          return $fila;
    }

   public function editar($id)
   {
	   	$data = array (
	   	'nombre_obrero'=>$this->input->post('nombre_obrero'),
		'a_paterno'=>$this->input->post('a_paterno'),
		'a_materno'=>$this->input->post('a_materno'),
		'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),
		'estado_civil'=>$this->input->post('estado_civil'),
		'sexo'=>$this->input->post('sexo'),
		'estado'=>$this->input->post('estado'),
		'municipio'=>$this->input->post('municipio'),
		'localidad'=>$this->input->post('localidad'),
		'direccion'=>$this->input->post('direccion'),
		'cp'=>$this->input->post('cp'),
		'lada'=>$this->input->post('lada'),
		'num_telefono'=>$this->input->post('num_telefono'),
		'celular'=>$this->input->post('celular'),
		'email'=>$this->input->post('email'),
		'puestos_id_tipo_puesto'=>$this->input->post('puestos_id_tipo_puesto'),
		'oficina_id_oficina'=>$this->input->post('oficina_id_oficina'),
		'comentario'=>$this->input->post('comentario'),
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina')

	);

	$this->db->where('id_obrero', $id);
	$this->db->update('obrero',$data);
   }

   public function guardar()
   {
   		$data = array (
					   	'nombre_obrero'=>$this->input->post('nombre_obrero'),
						'a_paterno'=>$this->input->post('a_paterno'),
						'a_materno'=>$this->input->post('a_materno'),
						'fecha_nacimiento'=>$this->input->post('fecha_nacimiento'),
						'estado_civil'=>$this->input->post('estado_civil'),
						'sexo'=>$this->input->post('sexo'),
						'estado'=>$this->input->post('estado'),
						'municipio'=>$this->input->post('municipio'),
						'localidad'=>$this->input->post('localidad'),
						'cp'=>$this->input->post('cp'),
						'direccion'=>$this->input->post('direccion'),
						'lada'=>$this->input->post('lada'),
						'num_telefono'=>$this->input->post('num_telefono'),
						'celular'=>$this->input->post('celular'),
						'email'=>$this->input->post('email'),
						'puestos_id_tipo_puesto'=>$this->input->post('puestos_id_tipo_puesto'),
						'oficina_id_oficina'=>$this->input->post('oficina_id_oficina'),
						'comentario'=>$this->input->post('comentario'),
						'fecha_ingreso'=>date('y-m-d'),
						'activo'=>1,
				        'id_usuario'=>$this->session->userdata('id'),
				        'id_sucursal'=>$this->session->userdata('oficina')
						);
   		$this->db->insert('obrero', $data);
		return $this->db->affected_rows();
   }

   public function eliminar($id)
   {
	    $data = array('activo' => 0);
				$this->db->where('id_obrero', $id);
				$this->db->update('obrero', $data);
				return $this->db->affected_rows();
   }
}
?>