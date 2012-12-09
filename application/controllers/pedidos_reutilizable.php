<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Pedidos_reutilizable extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("pedidos_reutilizable_model", "pedidos");
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
        $data['vista']='pedidos_reutilizable/index';
		$data['titulo']='Pedidos Proveedores  Reutilizable';
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

     $consul = $this->db->query('SELECT * from pedidos_reutilizable');
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
            $data = array();
        }else{
        $resultado_ =$this->pedidos->get_pedido_proveedor_reutilizable($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        if ($this->permisos->permisos(17,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido_reutilizable;
            if (($this->permisos->permisos(17,1)==1)&&($this->permisos->permisos(17,3)==1)){

               $onclik="onclick=eliminar_pedido('".$row->id_pedido_reutilizable."')";               
        	   $onclikedit="onclick=edit('".$row->id_pedido_reutilizable."')";
                
                if($row->activo == 1){
                $onclikabierto="onclick=abierto('".$row->id_pedido_reutilizable."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';

               }elseif ($row->activo == 0) {
                $onclikcerrado="onclick=cerrado('".$row->id_pedido_reutilizable."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';

               }
            }elseif (($this->permisos->permisos(17,1)==1)&&($this->permisos->permisos(17,3)==0)) {

               //$onclik="onclick=eliminar_pedido('".$row->id_pedido_reutilizable."')";               
               $onclikedit="onclick=edit('".$row->id_pedido_reutilizable."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';

            }elseif (($this->permisos->permisos(17,1)==0)&&($this->permisos->permisos(17,3)==1)) {

               $onclik="onclick=eliminar_pedido('".$row->id_pedido_reutilizable."')";               
               //$onclikedit="onclick=edit('".$row->id_pedido_reutilizable."')";
                 $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

            }elseif (($this->permisos->permisos(17,1)==0)&&($this->permisos->permisos(17,3)==0)) {
                    $acciones='';

                }
           $data->rows[$i]['cell']=array($acciones,
                                    $row->nombre_empresa,
                                    $row->cantidad,
                                    $row->nombre_oficina,
                                    $row->fecha_pedido,
                                    $row->fecha_entrega);
           $i++;
        }
    }
    }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }
///////////////////////////////////////funcion para extraer los registros de pedido reutilizable, cumpliendo la condicion de que se allan cerrado los pedidos/////////////////////////////////////////
public function paginacion_stock_reutilizable()
    {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from pedidos_reutilizable where pedidos_reutilizable.activo = "0" AND  pedidos_reutilizable.verificacion_almacen = "1"');
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
        $resultado_ =$this->pedidos->get_pedido_proveedor_reutilizable_stock($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido_reutilizable;
          if($row->verificacion_almacen == 1 ){
                $onclikabierto="onclick=abierto_reutilizable('".$row->id_pedido_reutilizable."')";
                $acciones='<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Sin verificar" height="18" /></span>';
           }elseif ($row->verificacion_almacen == 0) {
               $onclikcerrado="onclick=cerrado_reutilizable('".$row->id_pedido_reutilizable."')";
               $acciones='<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Verificado" height="18" /></span>';

           }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->cantidad),
                                    strtoupper($row->nombre_empresa),
                                    strtoupper($row->nombre_oficina));
           $i++;
        }
        // La respuesta se regresa como json
        echo json_encode($data);
    }

    public function get($id)
    {
        $row=$this->pedidos->get_id($id);
        echo strtoupper($row->fecha_entrega).'~'.
             strtoupper($row->proveedores_id_proveedores).'~'.
             strtoupper($row->oficina).'~'.
             strtoupper($row->cantidad);
    }

    public function editar_pedido($id)
    {
        $editar=$this->pedidos->editar($id);
        echo 1;
    }

    public function guardar()
    {
        $save=$this->pedidos->guardar();
        echo $save;
    }

    public function guardar_pedido()
    {
        $save=$this->pedidos->guardar_pedido();
        echo $save;
    }

    public function eliminar_pedido($id)
    {
        $delete=$this->pedidos->eliminar_pedido($id);
        if($delete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }


     public function eliminar_producto($id)
    {
        $delete=$this->pedidos->eliminar_producto($id);
        if($delete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }

    ///////////////////////////////////////////////////////////////////Sub paginacion ///////////////////////////////////////////////////////////////////////////////////
public function subpaginacion($id)
{


    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

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
    if ($start < 0) $start = 0;
    $consulta = "SELECT
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
                        GROUP BY cantidad_pedido.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
    foreach($result1->result() as $row) {

      $data->rows[$i]['id']=$row->id_cantidad_pedido;
       $onclik="onclick=eliminar_producto('".$row->id_cantidad_pedido."')";;
 $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->nombre),
                                    strtoupper($row->ancho),
                                    strtoupper($row->largo),
                                    strtoupper($row->cantidad));
        $i++;
    }
    // La respuesta se regresa como json
    echo json_encode($data);
}

///////////////////////////paginacion productos

public function paginacion_producto($id)
    {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT
                                        cat_mprima.nombre,
                                        cat_mprima.ancho,
                                        cat_mprima.largo,
                                        cantidad_pedido.cantidad,
                                        resistencia_mprima.resistencia
                                        FROM
                                        cantidad_pedido ,
                                        cat_mprima ,
                                        resistencia_mprima
                                        WHERE
                                        cantidad_pedido.id_pedido = $id AND
                                        cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima AND
                                        cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
                                        resistencia_mprima.activo = 1
                                        GROUP BY
                                        cantidad_pedido.cantidad
                                        ORDER BY
                                        cantidad_pedido.id_pedido ASC");
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
        $consulta = "SELECT
                        cantidad_pedido.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.caracteristica,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cantidad_pedido.cantidad
                        FROM
                        cantidad_pedido ,
                        pedido_proveedor ,
                        cat_mprima
                        WHERE
                        cantidad_pedido.id_pedido = $id AND
                        cantidad_pedido.catalogo_producto = cat_mprima.id_cat_mprima
                        GROUP BY cantidad_pedido.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limite;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
    foreach($result1->result() as $row) {

      $data->rows[$i]['id']=$row->id_cantidad_pedido;
       $onclik="onclick=delet_org('".$row->id_cantidad_pedido."')";
       $onclikedit="onclick=edit_org('".$row->id_cantidad_pedido."')";
 $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';
        $data->rows[$i]['cell']=array($acciones,$row->id_cantidad_pedido,
                                    strtoupper($row->nombre),
                                    strtoupper($row->caracteristica),
                                    strtoupper($row->ancho),
                                    strtoupper($row->largo),
                                    strtoupper($row->cantidad));
        $i++;
    }
    // La respuesta se regresa como json
    echo json_encode($data);
    }
         //////////////////////////// cerrar pedido ///////////////////////////////////
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
        $row=$this->pedidos->get_pedido_reutilizable($id);
        echo strtoupper($row->nombre_empresa).'~'.
             strtoupper($row->cantidad);

    }

}