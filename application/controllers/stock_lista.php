<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Stock_lista extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("stock_lista_model", "stock");
	}

	public function index()
	{
        $data['vista']='stock/index';
		$data['titulo']='Stock';
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

     $consul = $this->db->query('SELECT * from stock_linea');
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
        $resultado_ =$this->stock->get_stock_lista($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
            $acciones="hola";
           $data->rows[$i]['id']=$row->id_stock_linea;
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->nombre),
                                    strtoupper($row->ancho),
                                    strtoupper($row->largo),
                                    strtoupper($row->corrugado),
                                    strtoupper($row->resistencia),
                                    strtoupper($row->cantidad)
                                    );
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }
    public function add_stock()
        {
        $save=$this->stock->add_stock();
        echo $save;
        }	
}