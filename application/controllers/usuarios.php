<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller {
        public function __construct(){
		parent::__construct();
		$this->load->library('session');
		// include the driver class
		$this->load->model("roles_model","roles");
		$this->load->model("usuarios_model","usuarios");
		$this->load->model("oficina_model","oficina");
            if(!$this->redux_auth->logged_in()){//verificar si el el usuario ha iniciado sesion
                redirect(base_url().'inicio/logout');
            //echo 'denegado';
            }
 //inicializamos las variables MENU Y SIBMENU, por si no se enviaran desde la url
        $menu=0;
        $submenu=0;
        //verificamos si se enviaron las variables GET->m "(menu)" GET->submain"(submenu)"
        if (isset($_GET['m'])||isset($_GET['submain'])) {
            //si se enviaorn las variables GET condicionamos que sean solo numericas
            if (!is_numeric($_GET['m']) || !is_numeric($_GET['submain'])) {
                //si no son njumericas que cierre la session actual
                 redirect(base_url().'inicio/logout');
            }else{
                //en caso de que si fueran numericas agregamos la variables GET a las variables previamente creadas.
                $menu=$_GET['m'];
                $submenu=$_GET['submain'];
                //validamos el menu y submenu
                $this->permisos->permisosURL($menu,$submenu);
               }
        }

  }//****Constructor...
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function oficina()
	{
	    $id_user= $this->session->userdata('id'); //id usuario
	    $oficina="select oficina_id_oficina from usuarios where id = ".$id_user;
	    $oficina=$this->db->query($oficina);
	    $oficina = $oficina->row();
	    $oficina = $oficina->oficina_id_oficina;
	    return $oficina;
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function index()
	{
	//$this->load->view('login/acceso');
	$data['roles']=$this->roles->get();
	$data['oficina']=$this->oficina();
	$data['oficina']=$this->oficina->get();
	$data['vista']='usuarios/index';;
	$data['titulo']='Usuarios';
    $data['vistaa']="menu_izquierda";
    $data['vistab']="menu";
    $this->load->view('principal',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function paginacion()
{

 $where='WHERE usuarios.id_roles = roles.id_roles and usuarios.status = 1';

    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
    // $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar
 $consul = $this->db->query('SELECT usuarios.email, usuarios.id,  roles.nombre_rol, usuarios.`user` FROM usuarios , roles  '.$where);
 $count = $consul->num_rows();
    //En base al numero de registros se obtiene el numero de paginas
    if( $count >0 ) {
	$total_pages = ceil($count/$limit);
    } else {
	$total_pages = 0;
    }
    if ($page > $total_pages)
        $page=$total_pages;

    //Almacena numero de registro donde se va a empezar a recuperar los registros para la pagina
    $start = $limit*$page - $limit;
    //Consulta que devuelve los registros de una sola pagina
    //if ($start < 0) $start = 0;
    if ($start < 0){
        $start = 0;
        $data();
    }else{
    $consulta = "SELECT usuarios.email, usuarios.id,usuarios.nombre, roles.nombre_rol, usuarios.`user` FROM usuarios , roles  ".$where." ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
    if ($this->permisos->permisos(2,2)==1) {

    foreach($result1->result() as $row) {

       $data->rows[$i]['id']=$row->id;
    if (($this->permisos->permisos(2,1)==1)&&($this->permisos->permisos(2,3)==1)){

       $onclik="onclick=delet('".$row->id."')";
	   $onclikedit="onclick=edit('".$row->id."')";
       $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
    }elseif (($this->permisos->permisos(2,1)==1)&&($this->permisos->permisos(2,3)==0)) {
       //$onclik="onclick=delet('".$row->id."')";
       $onclikedit="onclick=edit('".$row->id."')";
       $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';

        }elseif (($this->permisos->permisos(2,1)==0)&&($this->permisos->permisos(2,3)==1)) {
       $onclik="onclick=delet('".$row->id."')";
       //$onclikedit="onclick=edit('".$row->id."')";
       $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        }elseif (($this->permisos->permisos(2,1)==0)&&($this->permisos->permisos(2,3)==0)) {
          $acciones='';

            }
        $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),$row->user,$row->email,strtoupper($row->nombre_rol));
        $i++;
        }
    }
}
	// La respuesta se regresa como json
    echo json_encode($data);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function buscando()
{

$filters = $_POST['filters'];

        $where = "";
        if (isset($filters)) {
            $filters = json_decode($filters);
 			$where='WHERE usuarios.id_roles = roles.id_roles and usuarios.status = 1 and ';
            $whereArray = array();
            $rules = $filters->rules;

            foreach($rules as $rule) {
                $whereArray[] = $rule->field." like '%".$rule->data."%'";
            }
            if (count($whereArray)>0) {
                $where .= join(" and ", $whereArray);
            } else {
 			$where=' WHERE usuarios.id_roles = roles.id_roles and usuarios.status = 1 ';
            }
        }

 $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

  $consul = $this->db->query('SELECT usuarios.email, usuarios.id,  roles.nombre_rol, usuarios.`user` FROM usuarios , roles  '.$where);
 $count = $consul->num_rows();
 	if($consul->num_rows()==0)
{
echo json_encode('null');

exit();
}

    //En base al numero de registros se obtiene el numero de paginas
    if( $count >0 ) {
	$total_pages = ceil($count/$limit);
    } else {
	$total_pages = 0;
    }
    if ($page > $total_pages)
        $page=$total_pages;

    //Almacena numero de registro donde se va a empezar a recuperar los registros para la pagina
    $start = $limit*$page - $limit;

    //Consulta que devuelve los registros de una sola pagina
    $consulta = "SELECT usuarios.email, usuarios.id,usuarios.nombre, roles.nombre_rol, usuarios.user FROM usuarios , roles  ".$where." ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

	if($result1->num_rows()==0)
{
echo 0;
exit();
}
    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
	foreach($result1->result() as $row) {
        $data->rows[$i]['id']=$row->id;
         $onclik="onclick=delet('".$row->id."')";
	     $onclikedit="onclick=edit('".$row->id."')";
         $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

        $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),$row->user,$row->email,strtoupper($row->nombre_rol));
        $i++;

    }
	// La respuesta se regresa como json
    echo json_encode($data);
   // echo $consulta;

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function get($id)
{
$result=$this->usuarios->get_id($id);
echo
    $result->oficina_id_oficina.'~'.
    $result->user.'~'.
    strtoupper($result->id_roles).'~'.
    $result->email.'~'.
    strtoupper($result->nombre);
}



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function guardar()
{
$save=$this->usuarios->guardar();

echo $save;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7

public function editar($id)
{
$editar=$this->usuarios->editar($id);
echo 1;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function borrar($id)
{
$delete=$this->usuarios->borrar($id);
if($delete > 0)
{
echo 1;
}
else
{
echo 0;
}

}

}//fin clase
?>