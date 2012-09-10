<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_bodega_prod_term extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('pedidos_bodega_prod_term_model','productos');
		$this->load->model('catalogo_producto_model','catalogo');
		$this->load->model('oficina_model','oficina');

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
         $data();
        }else{
        $resultado_ =$this->productos->get_pedido_bodega_producto($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(10,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
 if (($this->permisos->permisos(10,1)==1)&&($this->permisos->permisos(10,3)==1)){

           $onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';
           }
 }elseif (($this->permisos->permisos(10,1)==1)&&($this->permisos->permisos(10,3)==0)) {
        //$onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           $onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';
           }
}elseif (($this->permisos->permisos(10,1)==0)&&($this->permisos->permisos(10,3)==1)) {
           $onclik="onclick=eliminar_pedido('".$row->id_pedido."')";
           $onclick_add="onclick=add('".$row->id_pedido."')";
           //$onclikedit="onclick=edit('".$row->id_pedido."')";

           if($row->activo == 1)
           {
                $onclikabierto="onclick=abierto('".$row->id_pedido."')";
                $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclick_add.'><img src="'.base_url().'img/add_producto.ico" width="18" title="Agregar Producto" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikabierto.'><img src="'.base_url().'img/pedido_abierto.jpg" width="18" title="Cerrar Pedido" height="18" /></span>';
           }elseif ($row->activo == 0) {
               $onclikcerrado="onclick=cerrado('".$row->id_pedido."')";
               $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';
           }
        }elseif (($this->permisos->permisos(10,1)==0)&&($this->permisos->permisos(10,3)==0)) {
          $acciones='';

            }
           $data->rows[$i]['cell']=array($acciones,
                                    strtoupper($row->id_pedido),
                                    strtoupper($row->fecha_pedido),
                                    strtoupper($row->fecha_entrega),
                                    strtoupper($row->oficina_pedido),
                                    strtoupper($row->oficina_envio));
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
									cantidad_pedido_producto.cantidad
									-- cantidad_pedido_producto.observaciones
									FROM
									cantidad_pedido_producto ,
									catalogo_producto
                                    WHERE
                                    cantidad_pedido_producto.id_pedido = '$id' AND
                                    cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
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
									cantidad_pedido_producto.observaciones
									FROM
									cantidad_pedido_producto ,
									catalogo_producto
                                    WHERE
                                    cantidad_pedido_producto.id_pedido = '$id' AND
                                    cantidad_pedido_producto.catalogo_producto = catalogo_producto.id_catalogo
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
                                    $row->observaciones);
        $i++;
        $N++;
    }

    }elseif ($valor == 0) {
 $N=1;
    foreach($result1->result() as $row) {

      $data->rows[$i]['id']=$row->id_cantidad_pedido;

        $onclik="onclick=pedido_cerrado('".$row->id_cantidad_pedido."')";
        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Eliminar" height="18" /></span>';



        $data->rows[$i]['cell']=array($acciones,
                                                ($N),
                                   $row->nombre,
                                    $row->cantidad,
                                    $row->observaciones);
        $i++;
        $N++;
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
             strtoupper($row->oficina);
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
}

/* End of file pedidos_bodega_prod_term.php */
/* Location: ./application/controllers/pedidos_bodega_prod_term.php */