<?php
class Usuarios_model extends CI_Model
{
    function __construct()
{
	parent::__construct();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function get()
{
$query="select * from usuarios where status = 1 order by id asc";
$query=$this->db->query($query);
return ($query->num_rows() > 0)? $query->result_array(): NULL;
}
//////////////////////////////////////////////////////////////////////////////////////////////7

public function get_id($id)
{
$query=$this->db->query("select * from usuarios where id=".$id);
$fila = $query->row();

return $fila;
}


//////////////////////////////////////////////////////////////////////////////////////////////7
public function guardar()
{

$password=crypt($this->input->post('password'),2);
        $data = array
					(
						'user' => $this->input->post('user'),
						'password' => $password,
						'id_roles'=>$this->input->post('id_roles'),
						'fecha_alta'=>date('Y-m-d-h:i:s'),
						'status' => 1,
						'email' => $this->input->post('email'),
						'nombre'=> $this->input->post('nombre'),
						'oficina_id_oficina'=>$this->input->post('id_oficina')	
						);

					$this->db->insert('usuarios', $data);
					return $this->db->affected_rows(); 
}


//////////////////////////////////////////////////////////////////////////////////////////////7

public function editar($id)
{


   $data = array
					(
						'user' => $this->input->post('user'),
						'id_roles'=>$this->input->post('id_roles'),
						'fecha_alta'=>date('Y-m-d-h:i:s'),
						'status' => 1,
						'email' => $this->input->post('email'),
						'nombre'=> $this->input->post('nombre'),
						'oficina_id_oficina'=>$this->input->post('id_oficina')
						);
	if($this->input->post('password') != '')
	{
	$password=crypt($this->input->post('password'),2);
	$data['password']=$password;
	}
	
	$this->db->where('id', $id);
	$this->db->update('usuarios', $data);

}
///////////////////////////////////////////////////////////////////////////////////////////////////7

public function borrar($id)
{
    $data = array('status' => 0);
			$this->db->where('id', $id);
			$this->db->update('usuarios', $data);
			return $this->db->affected_rows();
}


}
?>