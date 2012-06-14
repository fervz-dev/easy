<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Almacen_linea extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
    		$this->load->model("pedidos_proveedor_model", "pedidos");
            $this->load->model("proveedores_model","proveedores");
            $this->load->model("catalogo_mprima_model","catalogo_mprima");
            $this->load->model("oficina_model","oficina");

	}

	public function index()
	{
		
        //$data['pedidos']=$this->pedidos->get_pedidos_proveedores_all();
        $data['oficinas']=$this->oficina->get_oficinas_all();
        $data['proveedor']=$this->proveedores->get_proveedores_all();
        $data['resistencias']=$this->catalogo_mprima->get_resistencia_all();
        //$data['mprima']=$this->catalogo_mprima->get_cat_mprima();
        $data['vista']='almacen_linea/menu';
		$data['titulo']='Pedidos Proveedores';
        
		$this->load->view('principal',$data);
	}
    //////////////////////////////////crear codigo de pedido ///////////////////////////////////////////
    public function nuevo_code($id)
    {
        $row=$this->code->get_code($id);
        echo ($row->code);
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

     $consul = $this->db->query('SELECT * from pedido_proveedor ');
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
        $resultado_ =$this->pedidos->get_pedido_proveedor_almacen($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
           if($row->verificacion_almacen == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Sin verificar" height="18" /></span>';
           }elseif ($row->verificacion_almacen == 0) {
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Verificado" height="18" /></span>';
           }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->id_pedido),
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->nombre_empresa),
                                    strtoupper($row->nombre_oficina));
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

   

    ///////////////////////////////////////////////////////////////////Sub paginacion ///////////////////////////////////////////////////////////////////////////////////
public function subpaginacion($id)
{   
       
 
    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

$verificacion = $this->db->query("SELECT
                                        cantidad_pedido.codigo
                                        FROM
                                        cantidad_pedido
                                        WHERE
                                        cantidad_pedido.id_pedido = '$id'"
                                );
 $consul = $this->db->query("SELECT
                                    cantidad_pedido.id_cantidad_pedido,
                                    cat_mprima.nombre,
                                    cat_mprima.ancho,
                                    cat_mprima.largo,
                                    cantidad_pedido.cantidad
                                    FROM
                                    cantidad_pedido ,
                                    pedido_proveedor ,
                                    cat_mprima
                                    WHERE
                                    cantidad_pedido.id_pedido = '$id' AND
                                    cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima
                                    GROUP BY
                                    cantidad_pedido.id_cantidad_pedido
                                    ORDER BY
                                    cat_mprima.nombre ASC
                        ");

if($consul->num_rows()==0)
{
echo 0;

exit();
}

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
    $consulta = "SELECT
                        cantidad_pedido.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cantidad_pedido.cantidad,
                        cantidad_pedido.codigo

                        FROM
                        cantidad_pedido ,
                        pedido_proveedor ,
                        cat_mprima
                        WHERE
                        cantidad_pedido.id_pedido = '$id' AND
                        cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima
                        GROUP BY cantidad_pedido.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
$con = $verificacion->row();
$valor = $con->codigo;

if ($valor == '') {
    $N=1;
    foreach($result1->result() as $row) {
    
      $data->rows[$i]['id']=$row->id_cantidad_pedido;
      
        $onclik="onclick=nuevo_code('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/code_activo.png" width="18" title="Crear Codigo" height="18" /></span>';   
      
      
       
        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                    strtoupper($row->nombre),
                                    strtoupper($row->ancho),
                                    strtoupper($row->largo),
                                    strtoupper($row->cantidad));
        $i++;
        $N++;
    }

    }elseif ($valor == 0) {
 $N=1;
    foreach($result1->result() as $row) {
    
      $data->rows[$i]['id']=$row->id_cantidad_pedido;
      
        $onclik="onclick=ver_codigo('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/code.png" width="18" title="Ver codigo" height="18" /></span>';   
      
      
       
        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                    strtoupper($row->nombre),
                                    strtoupper($row->ancho),
                                    strtoupper($row->largo),
                                    strtoupper($row->cantidad));
        $i++;
        $N++;
    }

    }
    

    // La respuesta se regresa como json
    echo json_encode($data);   
}

}