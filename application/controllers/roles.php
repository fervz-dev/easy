<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Roles extends CI_Controller {
        public function __construct(){
		parent::__construct();
		$this->load->library('session');
		// include the driver class

		$this->load->model("roles_model","roles");


            if(!$this->redux_auth->logged_in()){//verificar si el el usuario ha iniciado sesion
                redirect(base_url().'inicio');
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
	function oficinas()
	{
	    $id_user= $this->session->userdata('id'); //id usuario
	    $sucursal="select oficina_id_oficina from usuarios where id = ".$id_user;
	    $sucursal=$this->db->query($sucursal);
	    $sucursal = $sucursal->row();
	    $sucursal = $sucursal->oficina_id_oficina;
	    return $sucursal;
	}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function index()
	{
	//$this->load->view('login/acceso');
	$data['pantallas']=$this->roles->pantallas();
	$data['sucursal']=$this->oficinas();
	$data['vista']='roles/index';
	$data['titulo']='Roles';
    $data['vistaa']="menu_izquierda";
    $data['vistab']="menu";
    $this->load->view('principal',$data);
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function paginacion()
{

 $where=' where status = 1 ';

    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
    // $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar
 $consul = $this->db->query('SELECT * FROM roles '.$where);
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

    $consulta = "SELECT * FROM roles ".$where." ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
        if ($this->permisos->permisos(3,2)==1) {
            foreach($result1->result() as $row) {
               $data->rows[$i]['id']=$row->id_roles;
        if (($this->permisos->permisos(3,1)==1)&&($this->permisos->permisos(3,3)==1)){

               $onclik="onclick=delet('".$row->id_roles."')";
        	   $onclikedit="onclick=edit('".$row->id_roles."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        }elseif (($this->permisos->permisos(3,1)==1)&&($this->permisos->permisos(3,3)==0)) {
               //$onclik="onclick=delet('".$row->id_roles."')";
               $onclikedit="onclick=edit('".$row->id_roles."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';
         }elseif (($this->permisos->permisos(3,1)==0)&&($this->permisos->permisos(3,3)==1)) {

               $onclik="onclick=delet('".$row->id_roles."')";
               //$onclikedit="onclick=edit('".$row->id_roles."')";
               $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        }elseif (($this->permisos->permisos(3,1)==0)&&($this->permisos->permisos(3,3)==0)) {
                  $acciones='';

        }
            $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre_rol),strtoupper($row->dsc_rol));
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
            $where = " where status = 1 and ";
            $whereArray = array();
            $rules = $filters->rules;

            foreach($rules as $rule) {
                $whereArray[] = $rule->field." like '%".$rule->data."%'";
            }
            if (count($whereArray)>0) {
                $where .= join(" and ", $whereArray);
            } else {
                $where = " where status = 1 ";
            }
        }

 $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
//    $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar
 $consul = $this->db->query('SELECT * FROM roles '.$where);
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
    $consulta = "SELECT * FROM roles ".$where." ORDER BY $sidx $sord LIMIT $start , $limit;";
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
        $data->rows[$i]['id']=$row->id_roles;
         $onclik="onclick=delet('".$row->id_roles."')";
	     $onclikedit="onclick=edit('".$row->id_roles."')";
         $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

		 $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre_rol),strtoupper($row->dsc_rol));
        $i++;

    }
	// La respuesta se regresa como json
    echo json_encode($data);
   // echo $consulta;

}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function guardar()
{

//print_r($_POST);
$id_rol=$this->roles->guardar();
$this->roles->guarda_permisos($id_rol);

$this->session->set_flashdata('message', array('2'));
redirect(base_url().'roles?m=1&submain=3','refresh');
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function get($id)
{
$result=$this->roles->get_id($id);
echo strtoupper($result->nombre_rol).'~'.strtoupper($result->dsc_rol);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


public function editar($id)
{
$this->roles->editar($id);
$f=$this->roles->editar_permisos($id);
$this->roles->guarda_permisos($id);
$this->session->set_flashdata('message', array('1'));
redirect(base_url().'roles?m=1&submain=3','refresh');
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function borrar($id)
{
$delete=$this->roles->borrar($id);
if($delete > 0)
{
echo 1;
}
else
{
echo 0;
}

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
public function pantallas_permisos($id_rol)
{
$sql="select r.*,p.* from roles  r, permisos p where p.id_roles=r.id_roles and r.id_roles=".$id_rol." and r.status=1 and p.status=1";
$rol=$this->db->query($sql);
$rol= $rol->result_array();

$sql="select * from pantallas where status = 1";
$pantallas=$this->db->query($sql);
$pantallas = $pantallas->result_array();

$data['pantallas']=$pantallas;
$data['rol']=$rol;
$this->load->view("roles/pantallas",$data);
}
///////////////////////////////////////////////////////////////////////////////////////////
}//fin clase
?>