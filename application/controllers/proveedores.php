<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Proveedores extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
        $this->load->model("direcciones_model","direcciones");
        $this->load->model("proveedores_model","proveedores");


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
	}

	public function index()
	{

        $data['estados']=$this->direcciones->estados();
        $data['vista']='proveedores/index';
		$data['titulo']='proveedores';
         $data['vistaa']="vista1";
         $data['vistab']="m2";
		$this->load->view('principal',$data);
	}

	public function paginacion()
	{
		$page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from proveedores WHERE activo= "1"');
     $count = $consul->num_rows();
        //En base al numero de registros se obtiene el numero de paginas
        if( $count >0 ) {
    	$total_pages = ceil($count/$limite);
        } else {
    	$total_pages = 0;
        }
        if ($page > $total_pages)
            $page=$total_pages;

        //Almacena numero de registro donde se va a empezar a recuperar los registros para la pagina
        $start = $limite*$page - $limite;
        //Consulta que devuelve los registros de una sola pagina
        //if ($start < 0) $start = 0;
        if ($start < 0){
          $start = 0;
         $data();
        }else{
        $resultado_ =$this->proveedores->get_proveedores($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        if ($this->permisos->permisos(5,2)==1) {

        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_proveedores;
                   if (($this->permisos->permisos(5,1)==1)&&($this->permisos->permisos(5,3)==1)){

           $onclik="onclick=delet('".$row->id_proveedores."')";
    	   $onclikedit="onclick=edit('".$row->id_proveedores."')";
     	   $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        }elseif (($this->permisos->permisos(5,1)==1)&&($this->permisos->permisos(5,3)==0)) {
           //$onclik="onclick=delet('".$row->id_proveedores."')";
           $onclikedit="onclick=edit('".$row->id_proveedores."')";
           $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';

        }elseif (($this->permisos->permisos(5,1)==0)&&($this->permisos->permisos(5,3)==1)) {
           $onclik="onclick=delet('".$row->id_proveedores."')";
           //$onclikedit="onclick=edit('".$row->id_proveedores."')";
           $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

        }elseif (($this->permisos->permisos(5,1)==0)&&($this->permisos->permisos(5,3)==0)) {
             $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->nombre_contacto),
                                    strtoupper($row->nombre_empresa),
                                    $row->estado,
                                    $row->municipio,
                                    $row->localidad,
                                    strtoupper($row->cp),
                                    strtoupper($row->direccion),
                                    strtoupper($row->lada),
                                    strtoupper($row->num_telefono),
                                    strtoupper($row->ext),
                                    strtoupper($row->fax),
                                    $row->email,
                                    strtoupper($row->comentario));


           $i++;
        }
    }
}
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

    public function get($id)
    {
        $row=$this->proveedores->get_id($id);
        echo $row->nombre_contacto.'~'.
             $row->nombre_empresa.'~'.
             $row->estado.'~'.
             $row->municipio.'~'.
             $row->localidad.'~'.
             $row->cp.'~'.
             $row->direccion.'~'.
             $row->lada.'~'.
             $row->num_telefono.'~'.
             $row->ext.'~'.
             $row->fax.'~'.
             $row->email.'~'.
             $row->comentario;
    }

    public function editar_proveedores($id)
    {
        $editar=$this->proveedores->editar($id);
        echo 1;
    }

    public function guardar()
    {
        $save=$this->proveedores->guardar();
        echo $save;
    }

    public function eliminar($id)
    {
        $delete=$this->proveedores->eliminar($id);
        if($delete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

}