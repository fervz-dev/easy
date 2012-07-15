<?php
class Roles_model extends CI_Model
{
    function __construct()
{
	parent::__construct();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function pantallas()
{
$query="SELECT
pantallas.id_pantalla,
pantallas.nombre,
pantallas.descripcion,
pantallas.url,
pantallas.orden,
pantallas.imagen,
pantallas.`status`,
pantallas.id_usuario,
pantallas.id_sucursal,
pantallas.id_menu,
menu_principal.titulo_menu
FROM
pantallas ,
menu_principal
WHERE
pantallas.id_menu = menu_principal.id_menu AND
pantallas.`status` = '1'
ORDER BY
pantallas.id_menu ASC";
$query=$this->db->query($query);

return ($query->num_rows() > 0)? $query->result_array(): NULL;
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function get()
{
$query=$this->db->query("select * from roles where status = 1 order by nombre_rol");
return ($query->num_rows() > 0)? $query->result_array(): NULL;

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////77
public function guardar()
{
        $data = array
					(	'nombre_rol' => $this->input->post('nombre'),
						'dsc_rol' => $this->input->post('descripcion'),
						'status' => 1
						);

					$this->db->insert('roles', $data);
					return $this->db->insert_id(); 
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function guarda_permisos($id_rol)
{
$sql="select * from pantallas";
$query=$this->db->query($sql);

foreach ($query->result_array() as $pantallas)
{
			$perm=0;
			if(isset($_POST["pantalla".$pantallas['id_pantalla'].":1"]) || isset($_POST["pantalla".$pantallas['id_pantalla'].":2"]) || isset($_POST["pantalla".$pantallas['id_pantalla'].":3"]) || isset($_POST["pantalla".$pantallas['id_pantalla'].":4"])){
					if(!isset($_POST["pantalla".$pantallas['id_pantalla'].":1"]))
						$_POST["pantalla".$pantallas['id_pantalla'].":1"]=0;
					if(!isset($_POST["pantalla".$pantallas['id_pantalla'].":2"]))
						$_POST["pantalla".$pantallas['id_pantalla'].":2"]=0;
					if(!isset($_POST["pantalla".$pantallas['id_pantalla'].":3"]))
						$_POST["pantalla".$pantallas['id_pantalla'].":3"]=0;
					if(!isset($_POST["pantalla".$pantallas['id_pantalla'].":4"]))
						$_POST["pantalla".$pantallas['id_pantalla'].":4"]=0;
					
					
	$perm= $_POST["pantalla".$pantallas['id_pantalla'].":1"].$_POST["pantalla".$pantallas['id_pantalla'].":2"].$_POST["pantalla".$pantallas['id_pantalla'].":3"].$_POST["pantalla".$pantallas['id_pantalla'].":4"];			
				
				//$sql="INSERT INTO permisos(id_rol,id_pantalla,permiso,status) values('".$rol[0][id_rol]."','".$pantallas[$i][id_pantalla]."','".$perm."',1)";
				//mysql_db_query("wwwtrue_datos", $sql) or die("Error en Mysql");
		   $data = array
					(	'id_roles' => $id_rol,
						'id_pantalla' => $pantallas['id_pantalla'],
						'permiso' => $perm,
						'status'=>1
						);

					$this->db->insert('permisos', $data);
    	}
	}//foreach

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7

public function get_id($id)
{
$query=$this->db->query("select * from roles where id_roles=".$id);
$fila = $query->row();

return $fila;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////77


public function editar($id)
{
            $data = array
					(	'nombre_rol' => $this->input->post('nombre'),
						'dsc_rol' => $this->input->post('descripcion'),
						'status' => 1
						);
				$this->db->where('id_roles', $id);
						$this->db->update('roles', $data);


}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function editar_permisos($id)
{
$this->db->delete('permisos', array('id_roles' => $id));
return $this->db->affected_rows();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function borrar($id)
{
    $data = array('status' => 0);
			$this->db->where('id_roles', $id);
			$this->db->update('roles', $data);
			return $this->db->affected_rows();
}

}
?>