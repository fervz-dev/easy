<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Oficina extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model("tipo_oficina_model","tipo_oficina");
        $this->load->model("estados_model","estados");
		$this->load->model("oficina_model", "oficina");
        if(!$this->redux_auth->logged_in() ){//verificar si el el usuario ha iniciado sesion
            redirect(base_url().'inicio');
        //echo 'denegado';
        }
	}

	public function index()
	{
        $data['tipo_oficinas']=$this->tipo_oficina->get_tipo_oficinas_all();
        $data['estados']=$this->estados->get_estados_all();
		$data['vista']='oficina/index';
		$data['titulo']='Oficinas';
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

     $consul = $this->db->query('SELECT * from oficina WHERE activo= "1"');
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
        $resultado_catalogo =$this->oficina->get_oficina($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_catalogo as $row) {
           $data->rows[$i]['id']=$row->id_oficina;
           $onclik="onclick=delet('".$row->id_oficina."')";
    	   $onclikedit="onclick=edit('".$row->id_oficina."')";
     	   $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
           $data->rows[$i]['cell']=array($acciones,
                                        strtoupper($row->nombre_oficina), 
                                        strtoupper($row->nombre),
                                        strtoupper($row->direccion),
                                        strtoupper($row->colonia),
                                        strtoupper($row->telefono),
                                        strtoupper($row->rfc),
                                        strtoupper($row->observaciones),
                                        strtoupper($row->ciudad),
                                        strtoupper($row->dsc_estado),
                                        strtoupper($row->cp)
                                        );
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

    public function get($id)
    {
        $row=$this->oficina->get_id($id);
        echo strtoupper($row->nombre_oficina).'~'.
             strtoupper($row->tipo_oficina_id_tipo_oficina).'~'.
             strtoupper($row->direccion).'~'.
             strtoupper($row->colonia).'~'.
             strtoupper($row->telefono).'~'.
             strtoupper($row->rfc).'~'.
             strtoupper($row->ciudad).'~'.
             strtoupper($row->estado_id_estado).'~'.
             strtoupper($row->cp).'~'.
             strtoupper($row->logo).'~'.
             strtoupper($row->observaciones).'~'.
             strtoupper($row->coordx).'~'.
             strtoupper($row->coordy);
    }

    public function editar_oficina($id)
    {
        $editar=$this->oficina->editar($id);
        echo 1;
    }


    public function guardar()
    {
        $save=$this->oficina->guardar();
        echo $save;
    }

    public function eliminar($id)
    {
        $delete=$this->oficina->eliminar($id);
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