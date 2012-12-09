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
            $this->load->model("pedidos_bodega_model", "pedidos_bodega");
            $this->load->model("proveedores_model","proveedores");
            $this->load->model("catalogo_mprima_model","catalogo_mprima");
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

}

	public function index()
	{

        //$data['pedidos']=$this->pedidos->get_pedidos_proveedores_all();
        $data['oficinas']=$this->oficina->get_oficinas_all();
        $data['proveedor']=$this->proveedores->get_proveedores_all();
        $data['resistencias']=$this->catalogo_mprima->get_resistencia_all();
        //$data['mprima']=$this->catalogo_mprima->get_cat_mprima();
        // $data['vista']='almacen_linea/menu';
		$data['titulo']='Pedidos Proveedores';

		$this->load->view('principal',$data);
	}
    ///////////////////////verificacion de producto ////////////////////////
    // public function verificacion_producto($id)
    // {

    // }
    ///////////////////////verificacion del pedido en la tabla pedidos//////
     public function cerrar_pedido($id)
    {
        $cerrar=$this->pedidos->cerrar($id);
        if($cerrar > 0)
    {
        echo 1;
    }
   else
    {
        echo 0;
    }

    }

    public function verificacion_pedido($id)
    {
        $verificar=$this->pedidos->verificacion_model($id);
        if ($verificar>0) {
                   echo 1;
               }else{
                echo 0;
               }
    }

    ///////////////////////verificacion del pedido en la tabla pedidos//////
     public function cerrar_pedido_bodega($id)
    {
        $cerrar=$this->pedidos_bodega->cerrar($id);
        if($cerrar > 0)
    {
        echo 1;
    }
   else
    {
        echo 0;
    }

    }

    public function verificacion_pedido_bodega($id)
    {
        $verificar=$this->pedidos_bodega->verificacion_model($id);
        if ($verificar>0) {
                   echo 1;
               }else{
                echo 0;
               }
    }

    //////////////////////////////////crear codigo de pedido ///////////////////////////////////////////
   /* public function nuevo_code($id)
    {
        $row=$this->code->get_code($id);
        echo ($row->code);
    }*/

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

     $consul = $this->db->query("SELECT * from pedido_proveedor where pedido_proveedor.activo=0 AND  pedido_proveedor.oficina =".$this->session->userdata('oficina')." LIMIT 10 ");
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
        if ($start < 0){
            $start = 0;
        } else{

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
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

public function paginacion_bodega()
    {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from pedido_bodega where pedido_bodega.activo=0 LIMIT 10 ');
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
        $resultado_ =$this->pedidos_bodega->get_pedido_bodega_almacen($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
           if($row->verificacion_almacen == 1)
           {
                $onclikabierto="onclick=abierto_bodega('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Sin verificar" height="18" /></span>';
           }elseif ($row->verificacion_almacen == 0) {
               $onclikcerrado="onclick=cerrado_bodega('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Verificado" height="18" /></span>';
           }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->id_pedido),
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->oficina_pedido),
                                    strtoupper($row->oficina_envio));
           $i++;
        }
        // La respuesta se regresa como json
        echo json_encode($data);
    }

///////////////////////////////////////////////////////////////////Sub paginacion ///////////////////////////////////////////////////////////////////////////////////
public function subpaginacion_bodega($id)
{


    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

$verificacion_pedido_1 = $this->db->query("SELECT pedido_bodega.verificacion_almacen
                                            from pedido_bodega, cantidad_pedido_bodega
                                            WHERE
                                            pedido_bodega.activo = 0 AND
                                            pedido_bodega.id_pedido = '$id'
                                            GROUP BY
                                            pedido_bodega.id_pedido");
 $consul = $this->db->query("SELECT
                                    cantidad_pedido_bodega.id_cantidad_pedido,
                                    cat_mprima.nombre,
                                    cat_mprima.ancho,
                                    cat_mprima.largo,
                                    resistencia_mprima.resistencia,
                                    cantidad_pedido_bodega.cantidad,
                                    cantidad_pedido_bodega.verificacion
                                    FROM
                                    cantidad_pedido_bodega ,
                                    pedido_bodega ,
                                    cat_mprima,
                                    resistencia_mprima
                                    WHERE
                                    cantidad_pedido_bodega.id_pedido = '$id' AND
                                    cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
                                    cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima
                                    GROUP BY
                                    cantidad_pedido_bodega.id_cantidad_pedido
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
    if ($start < 0) $start = 0;
    //Consulta que devuelve los registros de una sola pagina
    $consulta = "SELECT
                        cantidad_pedido_bodega.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cat_mprima.tipo_m,
                        resistencia_mprima.resistencia,
                        cantidad_pedido_bodega.cantidad,
                        cantidad_pedido_bodega.codigo,
                        cantidad_pedido_bodega.verificacion
                        FROM
                        cantidad_pedido_bodega ,
                        pedido_bodega ,
                        cat_mprima,
                        resistencia_mprima
                        WHERE
                        cantidad_pedido_bodega.id_pedido = '$id' AND
                        cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima AND
                        cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
                        pedido_bodega.activo = 0
                        GROUP BY cantidad_pedido_bodega.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
///verificacion de pedido activo/////
$consulta_veri_0=$verificacion_pedido_1->row();
$consulta_veri_1=$consulta_veri_0->verificacion_almacen;


///condicion para asegurar que el pedido ya se alla verifcado////////////////////
if ($consulta_veri_1==0)
{
    $N=1;
    foreach($result1->result() as $row) {
        ///////////////////////////////////verificamos si el produto ya esta verificado////////////
        if ($row->verificacion==0) {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $onclik="onclick=verificacion_producto_pedido_bodega('".$row->id_cantidad_pedido."')";
            $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/alert-icon.png" width="18" title="verificar producto" height="18" /></span>';
            $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->tipo_m),
                                    strtoupper($row->resistencia),
                                    strtoupper($row->cantidad));
            $i++;
            $N++;
        }
        elseif($row->verificacion==1)
        {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $onclik="";
            $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Verificado" height="18" /></span>';



            $data->rows[$i]['cell']=array($acciones,
                                                    ($N),
                                        strtoupper($row->nombre),
                                        strtoupper($row->largo),
                                        strtoupper($row->ancho),
                                        strtoupper($row->tipo_m),
                                        strtoupper($row->resistencia),
                                        strtoupper($row->cantidad));
            $i++;
            $N++;

        }

    }

}
elseif($consulta_veri_1==1)
{
    $N=1;
    foreach($result1->result() as $row) {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $acciones='';
            $data->rows[$i]['cell']=array($acciones,
                                                    ($N),
                                        strtoupper($row->nombre),
                                        strtoupper($row->largo),
                                        strtoupper($row->ancho),
                                        strtoupper($row->tipo_m),
                                        strtoupper($row->resistencia),
                                        strtoupper($row->cantidad));
            $i++;
            $N++;

    }
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

$verificacion_pedido_1 = $this->db->query("SELECT pedido_proveedor.verificacion_almacen
                                            from pedido_proveedor, cantidad_pedido
                                            WHERE
                                            pedido_proveedor.activo = 0 AND
                                            pedido_proveedor.id_pedido = '$id'
                                            GROUP BY
                                            pedido_proveedor.id_pedido");
 $consul = $this->db->query("SELECT
                                    cantidad_pedido.id_cantidad_pedido,
                                    cat_mprima.nombre,
                                    cat_mprima.ancho,
                                    cat_mprima.largo,
                                    resistencia_mprima.resistencia,
                                    cantidad_pedido.cantidad,
                                    cantidad_pedido.verificacion
                                    FROM
                                    cantidad_pedido ,
                                    pedido_proveedor ,
                                    cat_mprima,
                                    resistencia_mprima
                                    WHERE
                                    cantidad_pedido.id_pedido = '$id' AND
                                    cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
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
    if ($start < 0) $start = 0;
    //Consulta que devuelve los registros de una sola pagina
    $consulta = "SELECT
                        cantidad_pedido.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cat_mprima.tipo_m,
                        resistencia_mprima.resistencia,
                        cantidad_pedido.cantidad,
                        cantidad_pedido.codigo,
                        cantidad_pedido.verificacion
                        FROM
                        cantidad_pedido ,
                        pedido_proveedor ,
                        cat_mprima,
                        resistencia_mprima
                        WHERE
                        cantidad_pedido.id_pedido = '$id' AND
                        cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima AND
                        cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
                        pedido_proveedor.activo = 0
                        GROUP BY cantidad_pedido.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
///verificacion de pedido activo/////
$consulta_veri_0=$verificacion_pedido_1->row();
$consulta_veri_1=$consulta_veri_0->verificacion_almacen;


///condicion para asegurar que el pedido ya se alla verifcado////////////////////
if ($consulta_veri_1==0)
{
    $N=1;
    foreach($result1->result() as $row) {
        ///////////////////////////////////verificamos si el produto ya esta verificado////////////
        if ($row->verificacion==0) {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $onclik="onclick=verificacion_producto_pedido_pedido('".$row->id_cantidad_pedido."')";
            $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/alert-icon.png" width="18" title="verificar producto" height="18" /></span>';
            $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->tipo_m),
                                    strtoupper($row->resistencia),
                                    strtoupper($row->cantidad));
            $i++;
            $N++;
        }
        elseif($row->verificacion==1)
        {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $onclik="";
            $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Verificado" height="18" /></span>';



            $data->rows[$i]['cell']=array($acciones,
                                                    ($N),
                                        strtoupper($row->nombre),
                                        strtoupper($row->largo),
                                        strtoupper($row->ancho),
                                        strtoupper($row->tipo_m),
                                        strtoupper($row->resistencia),
                                        strtoupper($row->cantidad));
            $i++;
            $N++;

        }

    }

}
elseif($consulta_veri_1==1)
{
    $N=1;
    foreach($result1->result() as $row) {
            $data->rows[$i]['id']=$row->id_cantidad_pedido;
            $acciones='';
            $data->rows[$i]['cell']=array($acciones,
                                                    ($N),
                                        strtoupper($row->nombre),
                                        strtoupper($row->largo),
                                        strtoupper($row->ancho),
                                        strtoupper($row->tipo_m),
                                        strtoupper($row->resistencia),
                                        strtoupper($row->cantidad));
            $i++;
            $N++;

    }
}


    // La respuesta se regresa como json
    echo json_encode($data);
}

}