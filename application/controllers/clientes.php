<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Clientes extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
        $this->load->model('direcciones_model','direcciones');
        $this->load->model("directorio_model","directorio");
        $this->load->model("clientes_model","clientes_");
        if(!$this->redux_auth->logged_in() ){//verificar si el el usuario ha iniciado sesion
            redirect(base_url().'inicio');
        //echo 'denegado';
        }

	}

	public function index()
	{

        $data['estados']=$this->direcciones->estados();
        $data['vista']='clientes/index';
		$data['titulo']='Clientes';
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

     $consul = $this->db->query('SELECT * from clientes WHERE activo= "1"');
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
        if ($start < 0) $start = 0;
        $resultado_ =$this->clientes_->get_clientes($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_clientes;
           $onclik="onclick=delet('".$row->id_clientes."')";
           $onclikedit="onclick=edit('".$row->id_clientes."')";
           $onclikdir="onclick=dire('".$row->id_clientes."')";
           $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikdir.'><img src="'.base_url().'img/directorio.png" width="18" title="directorio" height="18" /></span>';
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->nombre_empresa),
                                    strtoupper($row->nombre_contacto),
                                    strtoupper($row->tipo_persona),
                                    strtoupper($row->rfc),
                                    $row->estado,
                                    $row->municipio,
                                    $row->localidad,
                                    $row->direccion, 
                                    strtoupper($row->cp),
                                    strtoupper($row->lada),
                                    strtoupper($row->num_telefono),
                                    strtoupper($row->ext),
                                    strtoupper($row->fax),
                                    $row->email,
                                    $row->comentario,
                                    strtoupper($row->fecha_ingreso),
                                    );                        
           $i++;
        }
        // La respuesta se regresa como json
        echo json_encode($data);
    }

    public function get($id)
    {
        $row=$this->clientes_->get_id($id);
               echo strtoupper($row->nombre_empresa).'~'.
                    strtoupper($row->nombre_contacto).'~'.
                    strtoupper($row->tipo_persona).'~'.
                    strtoupper($row->rfc).'~'.
                    $row->estado.'~'.
                    $row->municipio.'~'.
                    $row->localidad.'~'.
                    strtoupper($row->direccion).'~'.
                    strtoupper($row->cp).'~'.
                    strtoupper($row->lada).'~'.
                    strtoupper($row->num_telefono).'~'.
                    strtoupper($row->ext).'~'.
                    strtoupper($row->fax).'~'.
                    $row->email.'~'.
                    $row->comentario;                        
    }

    public function editar_clientes($id)
    {
        $editar=$this->clientes_->editar($id);
        echo 1;
    }

    public function guardar()
    {
        $save=$this->clientes_->guardar();
        echo $save;
    }

    public function eliminar($id)
    {
        $delete=$this->clientes_->eliminar($id);
        if($delete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


    public function paginacion_directorio()
    {
        $id = $this->input->post('id');
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT * from direcciones WHERE activo= 1 AND clientes_id_clientes=$id");
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
        if ($start < 0) $start = 0;
        $resultado_ =$this->directorio->get_directorio($sidx, $sord, $start, $limite,$id);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_direcciones;
           $onclik_d="onclick=delet_dir('".$row->id_direcciones."')";
           $onclikguardar_d="onclick=alta_directorio('".$row->id_direcciones."')";
           $onclikedit_d="onclick=edit_dir('".$row->id_direcciones."')";
           $acciones='<span style=" cursor:pointer" '.$onclikedit_d.'><img title="Editar" src="'.base_url().'img/editar_dir.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik_d.'><img src="'.base_url().'img/eliminar_address.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikguardar_d.'><img src="'.base_url().'img/add_address.png" width="18" title="Eliminar" height="18" /></span>';
           $data->rows[$i]['cell']=array($acciones,
                                    $row->estado,
                                    $row->municipio,
                                    $row->localidad,
                                    $row->direccion,
                                    $row->comentario,
                                    );                        
           $i++;
        }
        // La respuesta se regresa como json
        echo json_encode($data);
    }
    
///////////////////////////   Directorio    ///////////////////////////
    public function get_directorio($id)
    {
        $row=$this->directorio->get_id($id);
               echo strtoupper($row->id_direcciones).'~'.
                    $row->estado.'~'.
                    $row->municipio.'~'.
                    $row->localidad.'~'.
                    $row->direccion.'~'.
                    $row->comentario;                        
    }
   public function editar_directorio_all()
    {
        $editar=$this->directorio->editar();
        echo 1;
    }

    public function guardar_nuevo()
    {
        $save=$this->directorio->guardar();
        echo $save;
    }
    public function comparar($id)
    {

        $row=$this->directorio->comparar($id);
               echo strtoupper($row->clientes_id_clientes);
    }
        public function eliminar_direccion($id)
    {
        $delete=$this->directorio->eliminar_direccion($id);
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