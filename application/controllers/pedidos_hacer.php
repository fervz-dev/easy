<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_hacer extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->model('pedidos_hacer_model','pedidos_producto');
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
    	// $data['estados']=$this->direcciones->estados();
        $data['vista']='pedidos_hacer/index';
        $data['titulo']='Peidos Pendientes';
        $this->load->view('principal',$data);
    }
    public function paginacion()
	{
		$page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación
    $oficina=$this->session->userdata('oficina');
        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT
                                        pedido_bodega_producto_terminado.id_pedido,
                                        pedido_bodega_producto_terminado.fecha_pedido,
                                        cantidad_pedido_producto.fecha_entrega,
                                        oficina.nombre_oficina
                                        FROM
                                        cantidad_pedido_producto ,
                                        pedido_bodega_producto_terminado ,
                                        catalogo_producto ,
                                        archivo,
                                        oficina
                                        WHERE
                                        cantidad_pedido_producto.id_bodega_hacer = 2 AND
                                        cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo AND
                                        cantidad_pedido_producto.id_pedido = pedido_bodega_producto_terminado.id_pedido AND
                                        cantidad_pedido_producto.verificacion = 1 AND
                                        cantidad_pedido_producto.validacion_bodega_hacer = 0 AND
                                        pedido_bodega_producto_terminado.activo = 0 AND
                                        pedido_bodega_producto_terminado.finalizado__pedido_bodega = 0 AND
                                        pedido_bodega_producto_terminado.verificacion_almacen = 1
                                        GROUP BY
                                        pedido_bodega_producto_terminado.id_pedido
                                        ORDER BY
                                        cantidad_pedido_producto.id_cantidad_pedido ASC
                                        ");
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
         $data="";
        }else{
        $resultado_ =$this->pedidos_producto->get_pedido_hacer($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(21,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
 if ($this->permisos->permisos(10,1)==1){

    	   $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->finalizado__pedido_bodega == 0)
           {
           		$onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';

           }elseif ($row->finalizado__pedido_bodega == 1) {

               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';
           }
 }elseif ($this->permisos->permisos(10,1)==0) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->id_pedido),
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->nombre_oficina));
           $i++;
        }
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
    $oficina=$this->session->userdata('oficina');

    if(!$sidx) $sidx =1;

// $verificacion = $this->db->query("SELECT
//                                         pedido_proveedor.activo
//                                         FROM
//                                         pedido_proveedor
//                                         WHERE
//                                         pedido_proveedor.id_pedido = '$id'"
//                              );
 $consul = $this->db->query("SELECT
								cantidad_pedido_producto.id_cantidad_pedido,
								cantidad_pedido_producto.cantidad,
								cantidad_pedido_producto.observaciones,
								cantidad_pedido_producto.fecha_entrega,
								catalogo_producto.nombre,
								catalogo_producto.largo,
								catalogo_producto.ancho,
								catalogo_producto.alto,
								catalogo_producto.resistencia,
								catalogo_producto.corrugado,
								catalogo_producto.score,
								catalogo_producto.descripcion,
								catalogo_producto.id_archivos,
								catalogo_producto.id_catalogo
								FROM
								cantidad_pedido_producto ,
								pedido_bodega_producto_terminado ,
								catalogo_producto ,
								archivo
								WHERE
								cantidad_pedido_producto.id_pedido = $id AND
								cantidad_pedido_producto.id_bodega_hacer = $oficina AND
								cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
								GROUP BY
								cantidad_pedido_producto.id_cantidad_pedido
								ORDER BY
								cantidad_pedido_producto.id_cantidad_pedido ASC
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
                        cantidad_pedido_producto.id_cantidad_pedido,
						cantidad_pedido_producto.cantidad,
						cantidad_pedido_producto.observaciones,
						cantidad_pedido_producto.fecha_entrega,
						catalogo_producto.nombre,
						catalogo_producto.largo,
						catalogo_producto.ancho,
						catalogo_producto.alto,
						catalogo_producto.resistencia,
						catalogo_producto.corrugado,
						catalogo_producto.score,
						catalogo_producto.descripcion,
						catalogo_producto.id_archivos,
						catalogo_producto.id_catalogo,
						cantidad_pedido_producto.validacion_bodega_hacer

						FROM
						cantidad_pedido_producto ,
						pedido_bodega_producto_terminado ,
						catalogo_producto ,
						archivo
						WHERE
						cantidad_pedido_producto.id_pedido = $id AND
						cantidad_pedido_producto.id_bodega_hacer =$oficina  AND
						cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
						GROUP BY
						cantidad_pedido_producto.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);
    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;

    $N=1;
    foreach($result1->result() as $row) {

      $data->rows[$i]['id']=$row->id_cantidad_pedido;
      if ($row->validacion_bodega_hacer==1) {

      	$onclik="onclick=finalizado_producto('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Finalizar producto" height="18" /></span>';

      }elseif ($row->validacion_bodega_hacer==0) {
      	$onclik="onclick=finalizar_producto('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Finalizar producto" height="18" /></span>';

      }



        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
												$row->cantidad,
												$row->observaciones,
												$row->fecha_entrega,
												$row->nombre,
												$row->largo,
												$row->ancho,
												$row->alto,
												$row->resistencia,
												$row->corrugado,
												$row->score,
												$row->descripcion,
												$row->id_archivos);
        $i++;
        $N++;
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
public function cerrar_producto($id)
{
	$cerrar=$this->pedidos_producto->cerrar_producto($id);
	if($cerrar > 0)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}

}

// cargar para usar en reutilizable
 public function paginacionUsar()
    {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación
    $oficina=$this->session->userdata('oficina');
        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT
                                        pedido_bodega_producto_terminado.id_pedido,
                                        pedido_bodega_producto_terminado.fecha_pedido,
                                        cantidad_pedido_producto.fecha_entrega,
                                        oficina.nombre_oficina
                                        FROM
                                        cantidad_pedido_producto ,
                                        pedido_bodega_producto_terminado ,
                                        catalogo_producto ,
                                        archivo,
                                        oficina
                                        WHERE
                                        cantidad_pedido_producto.id_bodega_hacer = 2 AND
                                        cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo AND
                                        cantidad_pedido_producto.id_pedido = pedido_bodega_producto_terminado.id_pedido AND
                                        cantidad_pedido_producto.verificacion = 1 AND
                                        cantidad_pedido_producto.validacion_bodega_hacer = 0 AND
                                        pedido_bodega_producto_terminado.activo = 0 AND
                                        pedido_bodega_producto_terminado.finalizado__pedido_bodega = 0 AND
                                        pedido_bodega_producto_terminado.verificacion_almacen = 1
                                        GROUP BY
                                        pedido_bodega_producto_terminado.id_pedido
                                        ORDER BY
                                        cantidad_pedido_producto.id_cantidad_pedido ASC
                                        ");
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
         $data="";
        }else{
        $resultado_ =$this->pedidos_producto->get_pedido_hacer($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(21,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
 if ($this->permisos->permisos(10,1)==1){

           $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->finalizado__pedido_bodega == 0)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='';

           }elseif ($row->finalizado__pedido_bodega == 1) {

               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='';
           }
 }elseif ($this->permisos->permisos(10,1)==0) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->id_pedido),
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->nombre_oficina));
           $i++;
        }
    }
}
        // La respuesta se regresa como json
        echo json_encode($data);
}




    ///////////////////////////////////////////////////////////////////Sub paginacion ///////////////////////////////////////////////////////////////////////////////////
public function subpaginacionUsar($id)
{


    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación
    $oficina=$this->session->userdata('oficina');

    if(!$sidx) $sidx =1;

// $verificacion = $this->db->query("SELECT
//                                         pedido_proveedor.activo
//                                         FROM
//                                         pedido_proveedor
//                                         WHERE
//                                         pedido_proveedor.id_pedido = '$id'"
//                              );
 $consul = $this->db->query("SELECT
                                cantidad_pedido_producto.id_cantidad_pedido,
                                cantidad_pedido_producto.cantidad,
                                cantidad_pedido_producto.observaciones,
                                cantidad_pedido_producto.fecha_entrega,
                                catalogo_producto.nombre,
                                catalogo_producto.largo,
                                catalogo_producto.ancho,
                                catalogo_producto.alto,
                                catalogo_producto.resistencia,
                                catalogo_producto.corrugado,
                                catalogo_producto.score,
                                catalogo_producto.descripcion,
                                catalogo_producto.id_archivos,
                                catalogo_producto.id_catalogo
                                FROM
                                cantidad_pedido_producto ,
                                pedido_bodega_producto_terminado ,
                                catalogo_producto ,
                                archivo
                                WHERE
                                cantidad_pedido_producto.id_pedido = $id AND
                                cantidad_pedido_producto.id_bodega_hacer = $oficina AND
                                cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
                                GROUP BY
                                cantidad_pedido_producto.id_cantidad_pedido
                                ORDER BY
                                cantidad_pedido_producto.id_cantidad_pedido ASC
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
                        cantidad_pedido_producto.id_cantidad_pedido,
                        cantidad_pedido_producto.cantidad,
                        cantidad_pedido_producto.observaciones,
                        cantidad_pedido_producto.fecha_entrega,
                        catalogo_producto.nombre,
                        catalogo_producto.largo,
                        catalogo_producto.ancho,
                        catalogo_producto.alto,
                        catalogo_producto.resistencia,
                        catalogo_producto.corrugado,
                        catalogo_producto.score,
                        catalogo_producto.descripcion,
                        catalogo_producto.id_archivos,
                        catalogo_producto.id_catalogo,
                        cantidad_pedido_producto.validacion_bodega_hacer

                        FROM
                        cantidad_pedido_producto ,
                        pedido_bodega_producto_terminado ,
                        catalogo_producto ,
                        archivo
                        WHERE
                        cantidad_pedido_producto.id_pedido = $id AND
                        cantidad_pedido_producto.id_bodega_hacer =$oficina  AND
                        cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
                        GROUP BY
                        cantidad_pedido_producto.id_cantidad_pedido
                        ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);
    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;

    $N=1;
    foreach($result1->result() as $row) {

      $data->rows[$i]['id']=$row->id_cantidad_pedido;
      if ($row->validacion_bodega_hacer==1) {

        $onclik="onclick=finalizado_producto('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Finalizar producto" height="18" /></span>';

      }elseif ($row->validacion_bodega_hacer==0) {
        $onclik="onclick=select_producto('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Seleccionar Producto" height="18" /></span>';

      }



        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                                $row->cantidad,
                                                $row->observaciones,
                                                $row->fecha_entrega,
                                                $row->nombre,
                                                $row->largo,
                                                $row->ancho,
                                                $row->alto,
                                                $row->resistencia,
                                                $row->corrugado,
                                                $row->score,
                                                $row->descripcion,
                                                $row->id_archivos);
        $i++;
        $N++;
}
    // La respuesta se regresa como json
    echo json_encode($data);

}

}

/* End of file pedidos_hacer.php */
/* Location: ./application/controllers/pedidos_hacer.php */
