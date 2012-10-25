<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
*/
class Pedidos_bodega extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("pedidos_bodega_model", "pedidos");
        //$this->load->model("proveedores_model","proveedores");
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
        $data['oficinas']=$this->oficina->get_oficinas_all_pedidos();
        //$data['proveedor']=$this->proveedores->get_proveedores_all();
        $data['resistencias']=$this->catalogo_mprima->get_resistencia_all();
        //$data['mprima']=$this->catalogo_mprima->get_cat_mprima();
        $data['vista']='pedidos_bodega/index';
        $data['titulo']='Pedidos a Bodegas';
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

     $consul = $this->db->query('SELECT * from pedido_bodega ');
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
        $resultado_ =$this->pedidos->get_pedido_bodega($sidx, $sord, $start, $limite);
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

    public function get($id)
    {
        $row=$this->pedidos->get_id($id);
        echo strtoupper($row->fecha_entrega).'~'.
             strtoupper($row->oficina_pedido).'~'.
             strtoupper($row->oficina);
    }

    public function editar_pedido($id)
    {
        $editar=$this->pedidos->editar($id);
        echo 1;
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

$verificacion = $this->db->query("SELECT
                                        pedido_bodega.activo
                                        FROM
                                        pedido_bodega
                                        WHERE
                                        pedido_bodega.id_pedido = '$id'"
                                );
 $consul = $this->db->query("SELECT
                                    cantidad_pedido_bodega.id_cantidad_pedido,
                                    cat_mprima.nombre,
                                    cat_mprima.ancho,
                                    cat_mprima.largo,
                                    cantidad_pedido_bodega.cantidad
                                    FROM
                                    cantidad_pedido_bodega ,
                                    pedido_bodega ,
                                    cat_mprima
                                    WHERE
                                    cantidad_pedido_bodega.id_pedido = '$id' AND
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
    //Consulta que devuelve los registros de una sola pagina
    if ($start < 0) $start = 0;
    $consulta = "SELECT
                        cantidad_pedido_bodega.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cantidad_pedido_bodega.cantidad
                        FROM
                        cantidad_pedido_bodega ,
                        pedido_bodega ,
                        cat_mprima
                        WHERE
                        cantidad_pedido_bodega.id_pedido = '$id' AND
                        cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima
                        GROUP BY cantidad_pedido_bodega.id_cantidad_pedido
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
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->cantidad));
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
                                        cantidad_pedido_bodega.cantidad,
                                        resistencia_mprima.resistencia
                                        FROM
                                        cantidad_pedido ,
                                        cat_mprima ,
                                        resistencia_mprima
                                        WHERE
                                        cantidad_pedido_bodega.id_pedido = $id AND
                                        cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima AND
                                        cat_mprima.resistencia_mprima_id_resistencia_mprima = resistencia_mprima.id_resistencia_mprima AND
                                        resistencia_mprima.activo = 1
                                        GROUP BY
                                        cantidad_pedido_bodega.cantidad
                                        ORDER BY
                                        cantidad_pedido_bodega.id_pedido ASC");
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
                        cantidad_pedido_bodega.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.caracteristica,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cantidad_pedido_bodega.cantidad
                        FROM
                        cantidad_pedido ,
                        pedido_proveedor ,
                        cat_mprima
                        WHERE
                        cantidad_pedido_bodega.id_pedido = $id AND
                        cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima
                        GROUP BY cantidad_pedido_bodega.id_cantidad_pedido
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
    public function verificacion_pedido($id)
    {
        $row=$this->pedidos->get_producto_($id);
        echo strtoupper($row->nombre).'~'.
             strtoupper($row->largo).'~'.
             strtoupper($row->ancho).'~'.
             strtoupper($row->tipo_m).'~'.
             strtoupper($row->cantidad).'~'.
             strtoupper($row->resistencia);

    }

/////////////////////////////////////listar los pedidos por nave
     public function paginacionLista()
    {
        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT * from pedido_bodega ');
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
        $resultado_ =$this->pedidos->get_pedido_bodegaNave($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(10,2)==1) {
        foreach($resultado_ as $row) {
           $data->rows[$i]['id']=$row->id_pedido;
 if (($this->permisos->permisos(10,1)==1)&&($this->permisos->permisos(10,3)==1)){

           $onclik="onclick=descontar_lista('".$row->id_pedido."')";

 $acciones='<span style=" cursor:pointer" '.$onclik.'><img title="Seleccionar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclikcerrado.'><img src="'.base_url().'img/pedido_cerrado.jpg" width="18" title="Pedido Cerrado" height="18" /></span>';


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

    ////////subpaginacion de materia prima por pedido de cada nave
    public function subpaginacionLista($id)
{


    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limit = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

$verificacion = $this->db->query("SELECT
                                        pedido_bodega.activo
                                        FROM
                                        pedido_bodega
                                        WHERE
                                        pedido_bodega.id_pedido = '$id'"
                                );
 $consul = $this->db->query("SELECT
                                    cantidad_pedido_bodega.id_cantidad_pedido,
                                    cat_mprima.nombre,
                                    cat_mprima.ancho,
                                    cat_mprima.largo,
                                    cantidad_pedido_bodega.cantidad
                                    FROM
                                    cantidad_pedido_bodega ,
                                    pedido_bodega ,
                                    cat_mprima
                                    WHERE
                                    cantidad_pedido_bodega.id_pedido = '$id' AND
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
    //Consulta que devuelve los registros de una sola pagina
    if ($start < 0) $start = 0;
    $consulta = "SELECT
                        cantidad_pedido_bodega.id_cantidad_pedido,
                        cat_mprima.nombre,
                        cat_mprima.ancho,
                        cat_mprima.largo,
                        cantidad_pedido_bodega.cantidad
                        FROM
                        cantidad_pedido_bodega ,
                        pedido_bodega ,
                        cat_mprima
                        WHERE
                        cantidad_pedido_bodega.id_pedido = '$id' AND
                        cantidad_pedido_bodega.catalogo_producto = cat_mprima.id_cat_mprima
                        GROUP BY cantidad_pedido_bodega.id_cantidad_pedido
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
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->cantidad));
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