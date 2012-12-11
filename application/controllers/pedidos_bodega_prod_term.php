<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_bodega_prod_term extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('pedidos_bodega_prod_term_model','productos');
		$this->load->model('catalogo_producto_model','catalogo');
		$this->load->model('oficina_model','oficina');
    $this->load->model('clientes_model','clientes');
    $this->load->model('pedido_producto_model', 'pedido_productos');

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
      $data['clientes']=$this->clientes->get_clientes_all();
    	$data['oficinas']=$this->oficina->get_oficinas_all_pedidos();
    	$data['vista']='pedidos_bodega_prod_term/index';
      $data['titulo']='Pedidos Productos Terminados a Bodegas';
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

     $consul = $this->db->query('SELECT * from pedido_bodega_producto_terminado ');
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
         $data=array();
        }else{
        $resultado_ =$this->productos->get_pedido_bodega_producto($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(20,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
 if (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==1)){

           $onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
            //0=terminado
            //1= no terminado
            if ($row->verificacion_almacen==1) {
               $verPedido="onclick=verPedido('".$row->id_pedido."')";

               $onclikverificaEnvio="onclick=verificaEnvio('".$row->id_pedido."')";
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$verPedido.'><img src="'.base_url().'img/verLista.png" width="18" title="Ver lista" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificaEnvio.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Verificar como terminado" height="18" /></span>';

            }elseif ($row->verificacion_almacen==0) {
               $onclikverificadoEnvio="onclick=verificadoEnvio('".$row->id_pedido."')";

               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";

               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificadoEnvio.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Producto terminado" height="18" /></span>';

            }

           }
 }elseif (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==0)) {
        //$onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";

                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$verPedido.'><img src="'.base_url().'img/verLista.png" width="18" title="Ver lista" height="18" />&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
            //0=terminado
            //1= no terminado
            if ($row->verificacion_almacen==1) {

               $verPedido="onclick=verPedido('".$row->id_pedido."')";

               $onclikverificaEnvio="onclick=verificaEnvio('".$row->id_pedido."')";

               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificaEnvio.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Verificar como terminado" height="18" /></span>';
             }elseif ($row->verificacion_almacen==0) {
               $onclikverificadoEnvio="onclick=verificadoEnvio('".$row->id_pedido."')";
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificadoEnvio.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Producto terminado" height="18" /></span>';


             }
           }
}elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==1)) {
           $onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           //$onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
            //0=terminado
            //1= no terminado
            if ($row->verificacion_almacen==1) {
               $verPedido="onclick=verPedido('".$row->id_pedido."')";

               $onclikverificaEnvio="onclick=verificaEnvio('".$row->id_pedido."')";

               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$verPedido.'><img src="'.base_url().'img/verLista.png" width="18" title="Ver lista" height="18" />&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificaEnvio.'><img src="'.base_url().'img/alert-icon.png" width="18" title="Verificar como terminado" height="18" /></span>';
            }elseif ($row->verificacion_almacen==0) {
               $onclikverificadoEnvio="onclick=verificadoEnvio('".$row->id_pedido."')";
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverificadoEnvio.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="Producto terminado" height="18" /></span>';

            }

           }
        }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->nombre_oficina),
                                    strtoupper($row->nombre_empresa),
                                    strtoupper($row->nombre)
                                    );
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

    if(!$sidx) $sidx =1;

$verificacion = $this->db->query("SELECT
                                        pedido_bodega_producto_terminado.activo
                                        FROM
                                        pedido_bodega_producto_terminado
                                        WHERE
                                        pedido_bodega_producto_terminado.id_pedido = '$id'"
                                );
 $consul = $this->db->query("SELECT
                                cantidad_pedido_producto.id_cantidad_pedido,
                                catalogo_producto.nombre,
                                cantidad_pedido_producto.cantidad,
                                cantidad_pedido_producto.observaciones,
                                oficina.nombre_oficina,
                                cantidad_pedido_producto.fecha_entrega
                                FROM
                                cantidad_pedido_producto ,
                                catalogo_producto ,
                                oficina
                                WHERE
                                cantidad_pedido_producto.id_pedido = '$id' AND
                                cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo AND
                                cantidad_pedido_producto.id_bodega_hacer = oficina.id_oficina
                                GROUP BY
                                cantidad_pedido_producto.id_cantidad_pedido
                                ORDER BY
                                catalogo_producto.nombre ASC
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
									catalogo_producto.nombre,
									cantidad_pedido_producto.cantidad,
									cantidad_pedido_producto.observaciones,
                  oficina.nombre_oficina,
                  cantidad_pedido_producto.fecha_entrega,
                  cantidad_pedido_producto.verificacion
									FROM
									cantidad_pedido_producto ,
									catalogo_producto ,
                  oficina
                  WHERE
                  cantidad_pedido_producto.id_pedido = '$id' AND
                  cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo AND
                  cantidad_pedido_producto.id_bodega_hacer = oficina.id_oficina
                  GROUP BY cantidad_pedido_producto.id_cantidad_pedido
                  ORDER BY $sidx $sord LIMIT $start , $limit;";
    $result1 = $this->db->query($consulta);

    // Se agregan los datos de la respuesta del servidor
    $data->page = $page;
    $data->total = $total_pages;
    $data->records = $count;
    $i=0;
$con = $verificacion->row();
$valor = $con->activo;

if ($valor == 1) {
    $N=1;
    foreach($result1->result() as $row) {

        $data->rows[$i]['id']=$row->id_cantidad_pedido;
        $onclik="onclick=eliminar_producto('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                    $row->nombre,
                                    $row->cantidad,
                                    $row->observaciones,
                                    $row->nombre_oficina,
                                    $row->fecha_entrega);
        $i++;
        $N++;
    }

    }elseif ($valor == 0) {
      $N=1;
        foreach($result1->result() as $row) {
          if ($row->verificacion==1) {

                  $data->rows[$i]['id']=$row->id_cantidad_pedido;
                  $onclikverficaPrudctoPedido="onclick=verficaPrudctoPedido('".$row->id_cantidad_pedido."')";
                  $onclik="onclick=pedido_cerrado('".$row->id_cantidad_pedido."')";
                  $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverficaPrudctoPedido.'><img src="'.base_url().'img/alert-icon.png" width="18" title="verificar producto como terminado" height="18" /></span>';
                  $data->rows[$i]['cell']=array($acciones,
                                                        ($N),
                                           $row->nombre,
                                            $row->cantidad,
                                            $row->observaciones,
                                            $row->nombre_oficina,
                                            $row->fecha_entrega);
                  $i++;
                  $N++;
          }elseif ($row->verificacion==0) {
             $data->rows[$i]['id']=$row->id_cantidad_pedido;
              $onclikverficadoPrudctoPedido="onclick=verficadoPrudctoPedido('".$row->id_cantidad_pedido."')";
              $onclik="onclick=pedido_cerrado('".$row->id_cantidad_pedido."')";
              $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikverficadoPrudctoPedido.'><img src="'.base_url().'img/verificado-icon.png" width="18" title="verificar producto como terminado" height="18" /></span>';
              $data->rows[$i]['cell']=array($acciones,
                                                    ($N),
                                       $row->nombre,
                                        $row->cantidad,
                                        $row->observaciones,
                                        $row->nombre_oficina,
                                        $row->fecha_entrega);
              $i++;
              $N++;

          }

        }

        }






    // La respuesta se regresa como json
    echo json_encode($data);
}
/////////////////giuardar pedido
    public function guardar_pedido()
    {
        $save=$this->productos->guardar_pedido();
        echo $save;
    }

  public function guardar()
  {
    $save=$this->productos->guardar();
    echo $save;
  }
 public function get($id)
    {
        $row=$this->productos->get_id($id);
        echo strtoupper($row->fecha_entrega).'~'.
             strtoupper($row->oficina_pedido).'~'.
             strtoupper($row->cliente)
             ;
    }

  public function editar_pedido($id)
  {
      $editar=$this->productos->editar($id);
      echo 1;
  }
   public function eliminar_pedido($id)
   {

    $this->db->trans_start();

    $data = array('id_pedido' => $id);
    $this->db->delete('cantidad_pedido_producto',$data);
    $data = array('id_pedido' => $id);
    $this->db->delete('pedido_bodega_producto_terminado',$data);

    $this->db->trans_complete();

    if ($this->db->trans_status()===FALSE) {
      return 0;
    }else{
      return 1;
    }
   }
  public function eliminar_producto($id)
  {
      $delete=$this->productos->eliminar_producto($id);
      if($delete > 0)
      {
          echo 1;
      }
      else
      {
          echo 0;
      }
  }

  //////////////////////////// cerrar pedido ///////////////////////////////////
    public function cerrar_pedido($id)
    {
        $cerrar=$this->productos->cerrar($id);
        if($cerrar > 0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

    }

      //////////////////////////// terminar pedido ///////////////////////////////////
    public function terminar_pedido($id)
    {
        $cerrar=$this->productos->terminar_pedido($id);
        if($cerrar > 0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

    }

      //////////////////////////// cerrar producto ///////////////////////////////////
    public function terminar_producto($id)
    {
        $cerrar=$this->productos->terminar_producto($id);
        if($cerrar > 0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

    }


    //paginacion de productos en la lista de pedidos
    public function listaPedidos($id)
 {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from pedido_productos WHERE pedido_productos.activo = 1 AND  pedido_productos.id_pedido = '.$id.' ');
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
         $data =array();
        }else{
        $resultado_ =$this->pedido_productos->getLista($id, $sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(20,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido_producto;
 if (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==1)){

           $onclik="onclick=eliminarProductoPedido('".$row->id_pedido_producto."')";
           $addCantidadProducto="onclick=addCantidadListado('".$row->id_pedido_producto."','1','".$id."')";
         $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span> <span style=" cursor:pointer" '.$addCantidadProducto.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==1)) {
           $onclik="onclick=eliminarProductoPedido('".$row->id_pedido_producto."')";
           $addCantidadProducto="onclick=addCantidadListado('".$row->id_pedido_producto."','1','".$id."')";
                $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span> <span style=" cursor:pointer" '.$addCantidadProducto.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                          $row->cantidad,
                                        // $row->id_pedido_producto,
                                        // $row->cantidad,
                                        $row->nombre,
                                        $row->largo,
                                        $row->ancho,
                                        $row->alto,
                                        $row->resistencia,
                                        $row->corrugado,
                                        $row->score
                                       
                                        // $row->descripcion
                                    );
           $i++;
        }
    }
}
        // La respuesta se regresa como json
        echo json_encode($data);
}
// guardar la lista de produtos del pedido
public function guardarListArray($id)
{
    $save=$this->pedido_productos->guardarListArray($id);
    echo $save;
}
public function subpaginacionPedidoProducto($id)
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
      componentes_producto.id_componentes_producto,
      componentes_producto.cantidad,
      catalogo_producto.nombre,
      catalogo_producto.largo,
      catalogo_producto.ancho,
      catalogo_producto.alto,
      resistencia_mprima.resistencia,
      catalogo_producto.corrugado,
      catalogo_producto.score,
      catalogo_producto.descripcion
FROM
      componentes_producto,
      catalogo_producto,
      resistencia_mprima
WHERE
componentes_producto.id_producto_pedido = $id AND
catalogo_producto.activo = 1 AND
catalogo_producto.id_catalogo=componentes_producto.id_componente AND
catalogo_producto.resistencia = resistencia_mprima.id_resistencia_mprima ");
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
         $data[]=0;
        }else{
        $resultado_ =$this->pedido_productos->getComponentesXProducto($sidx, $sord, $start, $limite,$id);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(20,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_componentes_producto;
 if (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==1)){

           $onclik="onclick=addCantidadListado('".$row->id_componentes_producto."','2','".$id."')";
          $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';


 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==1)) {
           $onclik="onclick=addCantidadListado('".$row->id_componentes_producto."','2','".$id."')";
          $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                          $row->cantidad,
                                        // $row->id_componentes_producto,
                                        // $row->cantidad,
                                        $row->nombre,
                                        $row->largo,
                                        $row->ancho,
                                        $row->alto,
                                        $row->resistencia,
                                        $row->corrugado,
                                        $row->score
                                       
                                        // $row->descripcion
                                    );
           $i++;
        }
    }
}
        // La respuesta se regresa como json
        echo json_encode($data);

}


// eliminar produto de la lista de pedidos
public function eliminarPorductoPedido($id)
{
        $delete=$this->pedido_productos->eliminarPorductoPedido($id);
      if($delete > 0)
      {
          echo 1;
      }
      else
      {
          echo 0;
      }
}

public function guardarCantidadProducto($id)
{
  $resultCantidad=$this->pedido_productos->guardarCantidadProducto($id);
  if ($resultCantidad>0) {
      echo 1;
  }else{
      echo 0;
  }
}

public function guardarCantidadComponente($id)
{
  $resultComponente=$this->pedido_productos->guardarCantidadComponente($id);
  if ($resultComponente>0) {
      echo 1;
  }else{
      echo 0;
  }
}
///////////////////////////////ver listado productos 
public function verListaPedidos($id)
 {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from pedido_productos WHERE pedido_productos.activo = 1 AND  pedido_productos.id_pedido = '.$id.' ');
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
         $data =array();
        }else{
        $resultado_ =$this->pedido_productos->getLista($id, $sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(20,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido_producto;
 if (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==1)){

           $onclik="onclick=eliminarProductoPedido('".$row->id_pedido_producto."')";
           $addCantidadProducto="onclick=addCantidadListado('".$row->id_pedido_producto."','1','".$id."')";
         $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span> <span style=" cursor:pointer" '.$addCantidadProducto.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==1)) {
           $onclik="onclick=eliminarProductoPedido('".$row->id_pedido_producto."')";
           $addCantidadProducto="onclick=addCantidadListado('".$row->id_pedido_producto."','1','".$id."')";
                $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span> <span style=" cursor:pointer" '.$addCantidadProducto.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array(
                                          $row->cantidad,
                                        // $row->id_pedido_producto,
                                        // $row->cantidad,
                                        $row->nombre,
                                        $row->largo,
                                        $row->ancho,
                                        $row->alto,
                                        $row->resistencia,
                                        $row->corrugado,
                                        $row->score
                                       
                                        // $row->descripcion
                                    );
           $i++;
        }
    }
}
        // La respuesta se regresa como json
        echo json_encode($data);
}

public function subpaginacionPedidoProductoLista($id)
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
      componentes_producto.id_componentes_producto,
      componentes_producto.cantidad,
      catalogo_producto.nombre,
      catalogo_producto.largo,
      catalogo_producto.ancho,
      catalogo_producto.alto,
      resistencia_mprima.resistencia,
      catalogo_producto.corrugado,
      catalogo_producto.score,
      catalogo_producto.descripcion
FROM
      componentes_producto,
      catalogo_producto,
      resistencia_mprima
WHERE
componentes_producto.id_producto_pedido = $id AND
catalogo_producto.activo = 1 AND
catalogo_producto.id_catalogo=componentes_producto.id_componente AND
catalogo_producto.resistencia = resistencia_mprima.id_resistencia_mprima ");
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
         $data[]=0;
        }else{
        $resultado_ =$this->pedido_productos->getComponentesXProducto($sidx, $sord, $start, $limite,$id);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(20,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_componentes_producto;
 if (($this->permisos->permisos(20,1)==1)&&($this->permisos->permisos(20,3)==1)){

           $onclik="onclick=addCantidadListado('".$row->id_componentes_producto."','2','".$id."')";
          $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';


 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==1)) {
           $onclik="onclick=addCantidadListado('".$row->id_componentes_producto."','2','".$id."')";
          $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/numeral.png" width="18" title="Agregar cantidad" height="18" /></span>';

 }elseif (($this->permisos->permisos(20,1)==0)&&($this->permisos->permisos(20,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array(
                                          $row->cantidad,
                                        // $row->id_componentes_producto,
                                        // $row->cantidad,
                                        $row->nombre,
                                        $row->largo,
                                        $row->ancho,
                                        $row->alto,
                                        $row->resistencia,
                                        $row->corrugado,
                                        $row->score
                                       
                                        // $row->descripcion
                                    );
           $i++;
        }
    }
}
        // La respuesta se regresa como json
        echo json_encode($data);

}
}

/* End of file pedidos_bodega_prod_term.php */
/* Location: ./application/controllers/pedidos_bodega_prod_term.php */