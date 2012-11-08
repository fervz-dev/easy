<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_naves_linea extends CI_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->model("stock_lista_model", "stock");
	$this->load->model("resistencia_mprima_model","resistencia");
	$this->load->model("reutilizable_ingreso_model","catalogo");
	$this->load->model('catalogo_producto_model','producto');
    $this->load->model("clientes_model","clientes_");
    $this->load->model("stock_productos_model","stock_productos");
    $this->load->model("stock_naves_model","naves");
    $this->load->model("oficina_model","oficina");
}

	public function index()
	{
	    $data['oficinas']=$this->oficina->get_oficinas_all();
        $data['vista']='stock_naves/stock_lista';
		$data['titulo']='Stock';
		$this->load->view('principal',$data);
	}


public function paginacion_linea($oficina)
{
	$page = $_POST['page'];  // Almacena el numero de pagina actual
    $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
    // $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT * from stock_linea where stock_linea.id_sucursal=".$oficina." ");
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
        $resultado_ =$this->naves->get_stock_lista($sidx, $sord, $start, $limite, $oficina);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {

           $data->rows[$i]['id']=$row->id_stock_linea;

        if ($row->cantidad>0) {

                $onclickUsar="onclick=usarLinea('".$row->id_stock_linea."')";
                $acciones='<span style=" cursor:pointer" '.$onclickUsar.'><img src="'.base_url().'img/usar.png" width="18" title="usar" height="18" /></span>';

        }else{
                $acciones='';
        }
           $data->rows[$i]['cell']=array(
                                    $row->id_stock_linea,
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->corrugado),
                                    strtoupper($row->resistencia),
                                    strtoupper($row->cantidad)
                                    );
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }

////////////////////////paginacion reutilizable por oficina
public function buscando($oficina)
{

$filters = $_POST['filters'];

        $where = "";
        if (isset($filters)) {
            $filters = json_decode($filters);
            $where = " where id_sucursal=".$oficina." AND ";
            $whereArray = array();
            $rules = $filters->rules;

            foreach($rules as $rule) {

                $whereArray[] = $rule->field." like '%".$rule->data."%'";

            }
            if (count($whereArray)>0) {

                $where .= join(" and ", $whereArray);
            } else {
                $where = " where id_sucursal=".$oficina." ";
            }
        }

 $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
//    $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar
 $consul = $this->db->query('SELECT * FROM stock_linea '.$where);
 $count = $consul->num_rows();
    if($consul->num_rows()==0)
{
echo json_encode('null');

exit();
}
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
        $resultado_ =$this->naves->get_stock_lista_search($where,$sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
        foreach($resultado_ as $row) {

           $data->rows[$i]['id']=$row->id_stock_linea;

        if ($row->cantidad>0) {

                $onclickUsar="onclick=usarLinea('".$row->id_stock_linea."')";
                $acciones='<span style=" cursor:pointer" '.$onclickUsar.'><img src="'.base_url().'img/usar.png" width="18" title="usar" height="18" /></span>';

        }else{
                $acciones='';
        }
           $data->rows[$i]['cell']=array(
                                    $row->id_stock_linea,
                                    strtoupper($row->nombre),
                                    strtoupper($row->largo),
                                    strtoupper($row->ancho),
                                    strtoupper($row->corrugado),
                                    strtoupper($row->resistencia),
                                    strtoupper($row->cantidad)
                                    );
           $i++;
        }
        // La respuesta se regresa como json
        echo json_encode($data);
}





	public function paginacion_reutilizable($oficina)
    {


    $page = $_POST['page'];  // Almacena el numero de pagina actual
    $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
    $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
    $sord = $_POST['sord'];  // Almacena el modo de ordenación

    if(!$sidx) $sidx =1;

    // Se crea la conexión a la base de datos
    // $conexion = new mysqli("servidor","usuario","password","basededatos");
    // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query("SELECT * from cat_mprima_reutilizable WHERE activo= '1' AND cat_mprima_reutilizable.id_sucursal =".$oficina." AND cat_mprima_reutilizable.tipo = 'reutilizable' ");
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
        $resultado_catalogo =$this->catalogo->get_cat_mprima($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;

        foreach($resultado_catalogo as $row) {
           $data->rows[$i]['id']=$row->id_cat_mprima;

            if ($row->restan>0) {
                $onclickUsar="onclick=usar('".$row->id_cat_mprima."')";
                $onclik="onclick=delet('".$row->id_cat_mprima."')";
                $onclikedit="onclick=edit('".$row->id_cat_mprima."')";
                $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclickUsar.'><img src="'.base_url().'img/usar.png" width="18" title="usar" height="18" /></span>';
            }else{
                  $onclik="onclick=delet('".$row->id_cat_mprima."')";
                   $onclikedit="onclick=edit('".$row->id_cat_mprima."')";
                   $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

            }


            $data->rows[$i]['cell']=array($acciones,
            strtoupper($row->nombre),
            //strtoupper($row->caracteristica),
            // strtoupper($row->tipo),
            strtoupper($row->tipo_m),
            strtoupper($row->ancho),
            strtoupper($row->largo),
            // strtoupper($row->peso),
            strtoupper($row->resistencia),
            strtoupper($row->cantidad),
            //strtoupper($row->peso_total),
            //strtoupper($row->tipoIngreso),
            //strtoupper($row->pesoLamina),
            //strtoupper($row->pesoMuestra),
            // strtoupper($row->restan)
            );
           $i++;
        }
    	// La respuesta se regresa como json
        echo json_encode($data);
    }
////////////////////////paginacion stock productos por oficina
public function paginacion_productos($oficina)
    {


        $page = $_POST['page'];  // Almacena el numero de pagina actual
        $limite = $_POST['rows']; // Almacena el numero de filas que se van a mostrar por pagina
        $sidx = $_POST['sidx'];  // Almacena el indice por el cual se hará la ordenación de los datos
        $sord = $_POST['sord'];  // Almacena el modo de ordenación

        if(!$sidx) $sidx =1;

        // Se crea la conexión a la base de datos
        // $conexion = new mysqli("servidor","usuario","password","basededatos");
        // Se hace una consulta para saber cuantos registros se van a mostrar

     $consul = $this->db->query('SELECT
                                        *
                                        FROM
                                        stock_producto
                                        WHERE
                                        stock_producto.activo = "1" AND stock_producto= ".$oficina." ');
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
        $resultado_catalogo =$this->stock_productos->get_cat_productos($sidx, $sord, $start, $limite, $oficina);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(25,2)==1) {

                foreach($resultado_catalogo as $row) {
                   $data->rows[$i]['id']=$row->id_catalogo;
                   ///todos lo permisos
                   if (($this->permisos->permisos(25,1)==1)&&($this->permisos->permisos(25,3)==1)){

                        $onclikedit="onclick=restar('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";

                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;';


                        // permisos solo para editar
                   }elseif (($this->permisos->permisos(25,1)==1)&&($this->permisos->permisos(25,3)==0)) {

                        $onclikedit="onclick=restar('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";

                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';
                        // permisos solo para eliminar
                   }elseif (($this->permisos->permisos(25,1)==0)&&($this->permisos->permisos(25,3)==1)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='';

// sin permisos
                   }elseif (($this->permisos->permisos(25,1)==0)&&($this->permisos->permisos(25,3)==0)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='';

                   }
                   $data->rows[$i]['cell']=array($acciones,
                               $row->nombre_cliente,
                               $row->nombre,
                               $row->largo,
                               $row->ancho,
                               $row->alto,
                               $row->resistencia,
                               $row->corrugado,
                               $row->score,
                               $row->descripcion,
                               $row->cantidad
                               );
                   $i++;
                }
        }
    }
        // La respuesta se regresa como json
        echo json_encode($data);
    }
}


/* End of file stock_naves.php */
/* Location: ./application/controllers/stock_naves.php */
