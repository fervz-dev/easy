<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Proveedores extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model("estados_model","estados");
        $this->load->model("proveedores_model","proveedores");
        if(!$this->redux_auth->logged_in() ){//verificar si el el usuario ha iniciado sesion
            redirect(base_url().'inicio');
        //echo 'denegado';
        }
	}

	public function index()
	{

        $data['estados']=$this->estados->get_estados_all();
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
        $resultado_ =$this->proveedores->get_proveedores($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_proveedores;
           $onclik="onclick=delet('".$row->id_proveedores."')";
    	   $onclikedit="onclick=edit('".$row->id_proveedores."')";
     	   $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->nombre_contacto),
                                    strtoupper($row->nombre_empresa),
                                    strtoupper($row->dsc_estado),
                                    strtoupper($row->cp),
                                    strtoupper($row->ciudad),
                                    strtoupper($row->direccion),
                                    strtoupper($row->lada),
                                    strtoupper($row->num_telefono),
                                    strtoupper($row->ext),
                                    strtoupper($row->fax),
                                    strtoupper($row->email),
                                    strtoupper($row->comentario));

                                    
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

    public function get($id)
    {
        $row=$this->proveedores->get_id($id);
        echo strtoupper($row->nombre_contacto).'~'.
             strtoupper($row->nombre_empresa).'~'.
             strtoupper($row->estado_id_estado).'~'.
             strtoupper($row->cp).'~'.
             strtoupper($row->direccion).'~'.
             strtoupper($row->ciudad).'~'.
             strtoupper($row->lada).'~'.
             strtoupper($row->num_telefono).'~'.
             strtoupper($row->ext).'~'.
             strtoupper($row->fax).'~'.
             strtoupper($row->email).'~'.
             strtoupper($row->comentario);
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