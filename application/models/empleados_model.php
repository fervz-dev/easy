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
		$query = $this->db->query("SELECT ob.id_obrero, ob.nombre_obrero, ob.a_paterno, ob.a_materno, ob.fecha_nacimiento, ob.direccion, ob.celular, ob.telefono_casa, pt.nombre, ofn.nombre_oficina,ob.estado_civil,ob.sexo, es.dsc_estado, ob.colonia, ob.ciudad
									FROM obrero ob, puestos pt, oficina ofn, estados es
									WHERE ob.puestos_id_tipo_puesto = pt.id_tipo_puesto
									AND ob.oficina_id_oficina = ofn.id_oficina
									AND ob.estado_id_estado = es.id_estado
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
										obrero.direccion,
										obrero.celular,
										obrero.telefono_casa,
										obrero.puestos_id_tipo_puesto,
										obrero.oficina_id_oficina,
										obrero.estado_civil,
										obrero.sexo,
										obrero.estado_id_estado,
										obrero.colonia,
										obrero.ciudad
										FROM
										obrero, oficina
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
		'direccion'=>$this->input->post('direccion'),
		'celular'=>$this->input->post('celular'),
		'telefono_casa'=>$this->input->post('telefono_casa'),
		'puestos_id_tipo_puesto'=>$this->input->post('puestos_id_tipo_puesto'),
		'oficina_id_oficina'=>$this->input->post('oficina_id_oficina'),
		'estado_civil'=>$this->input->post('estado_civil'),
		'sexo'=>$this->input->post('sexo'),
		'estado_id_estado'=>$this->input->post('estado_id_estado'),
		'colonia'=>$this->input->post('colonia'),
		'ciudad'=>$this->input->post('ciudad')
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
						'direccion'=>$this->input->post('direccion'),
						'celular'=>$this->input->post('celular'),
						'telefono_casa'=>$this->input->post('telefono_casa'),
						'puestos_id_tipo_puesto'=>$this->input->post('puestos_id_tipo_puesto'),
						'oficina_id_oficina'=>$this->input->post('oficina_id_oficina'),
						'estado_civil'=>$this->input->post('estado_civil'),
						'sexo'=>$this->input->post('sexo'),
						'estado_id_estado'=>$this->input->post('estado_id_estado'),
						'colonia'=>$this->input->post('colonia'),
						'ciudad'=>$this->input->post('ciudad'),
						'activo'=>1
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