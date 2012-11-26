<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_final extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("clientes_model","clientes_");
		$this->load->model('producto_final_model','producto');


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
		       //si no son numericas que cierre la session actual
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
		$data['clientes']=$this->clientes_->get_clientes_all();
        $data['vista']='producto_final/index';
        $data['titulo']='Catalogo de Productos';
        $data['error']='';
        $this->load->view('principal', $data);
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

     	$consul = $this->db->query('SELECT
                                        *
                                        FROM
                                        producto_final
                                        WHERE
                                        producto_final.activo = "1"');
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

        $resultado_catalogo =$this->producto->get_cat_productos($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(8,2)==1) {

                foreach($resultado_catalogo as $row) {
                   $data->rows[$i]['id']=$row->id_catalogo;
                   ///todos lo permisos
                   if (($this->permisos->permisos(8,1)==1)&&($this->permisos->permisos(8,3)==1)){

                        $onclikedit="onclick=edit('".$row->id_catalogo."','2')";
                        $onclik="onclick=delet('".$row->id_catalogo."','2')";

                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."','2')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=pictureCatalogoFinal('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }


                        // permisos solo para editar
                   }elseif (($this->permisos->permisos(8,1)==1)&&($this->permisos->permisos(8,3)==0)) {

                        $onclikedit="onclick=edit('".$row->id_catalogo."','2')";
                        //$onclik="onclick=delet('".$row->id_catalogo."','2')";
                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."','2')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=pictureCatalogoFinal('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }

                        // permisos solo para eliminar
                   }elseif (($this->permisos->permisos(8,1)==0)&&($this->permisos->permisos(8,3)==1)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."','2')";
                        $onclik="onclick=delet('".$row->id_catalogo."','2')";
                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."','2')";
                        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=pictureCatalogoFinal('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }

// sin permisos
                   }elseif (($this->permisos->permisos(8,1)==0)&&($this->permisos->permisos(8,3)==0)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."','2')";
                        //$onclik="onclick=delet('".$row->id_catalogo."','2')";
                        $acciones='';

                   }
                   $data->rows[$i]['cell']=array($acciones,
                               $row->nombre_empresa,
                               $row->nombre,
                               $row->largo,
                               $row->ancho,
                               $row->alto,
                               $row->resistencia,
                               $row->corrugado,
                               $row->score,
                               $row->descripcion
                               );
                   $i++;
                }
        }
    }
        // La respuesta se regresa como json
        echo json_encode($data);
    }
    public function guardar()
    {
        $save=$this->producto->guardar();
        echo $save;
    }
    //  public function get($id)
    // {
    //     $row=$this->producto->get_id($id);
    //                 echo   $row->id_cliente.'~'.
    //                        $row->nombre_producto.'~'.
    //                        $row->descripcion;
    // }
     public function get($id)
    {
        $row=$this->producto->get_id($id);
                    echo   $row->id_cliente.'~'.
                           $row->nombre.'~'.
                           $row->largo.'~'.
                           $row->ancho.'~'.
                           $row->alto.'~'.
                           $row->resistencia.'~'.
                           $row->corrugado.'~'.
                           $row->score.'~'.
                           $row->descripcion;
    }
    public function eliminar($id)
    {
        $delete=$this->producto->eliminar($id);
        if($delete > 0)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    }
    public function editar_producto($id)
    {
        $editar=$this->producto->editar($id);
        echo 1;
    }
    public function productosCliente($id_cliente)
    {
        $queryProductos=$this->producto->producto($id_cliente);
        $combo = "";
        $combo= '<option value="">Selecciones...</option>';
        for ($i=0; $i <count($queryProductos) ; $i++) {
             $combo .= "<option value='".$queryProductos[$i]["id_catalogo"]."'>".$queryProductos[$i]["nombre"]."</option>";
        }
        echo $combo;
    }
    public function get_imagen($id)
    {
        $row=$this->producto->get_imagen($id);
                    echo   $row->id_file.'~'.
                           $row->nombre_archivo;

    }
  ///extraer la imagen
public function eliminar_imagen($id,$id_catalogo)
{
    $delete=$this->producto->eliminar_imagen($id,$id_catalogo);
    if($delete > 0)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }
}

public function buscando()
{

$filters = $_POST['filters'];

        $where = "";
        if (isset($filters)) {
            $filters = json_decode($filters);
            $where = "";
            $whereArray = array();
            $rules = $filters->rules;

            foreach($rules as $rule) {

                if ($rule->field =='nombre_empresa') {

                  $whereArray[] = "clientes.nombre_empresa like '%".$rule->data."%' AND producto_final.activo = 1 AND resistencia_mprima.id_resistencia_mprima=producto_final.resistencia AND producto_final.id_cliente=clientes.id_clientes";

                }elseif ($rule->field=='resistencia') {

                if (($rule->data=='SG')||($rule->data=='sg')) {
                   $whereArray[] = " resistencia_mprima.resistencia LIKE '%".$rule->data."%' AND producto_final.activo = 1 AND resistencia_mprima.id_resistencia_mprima=producto_final.resistencia AND producto_final.id_cliente=clientes.id_clientes";
                    }else{
                   $whereArray[] = "resistencia_mprima.resistencia=".$rule->data." AND producto_final.activo = 1 AND resistencia_mprima.id_resistencia_mprima=producto_final.resistencia AND producto_final.id_cliente=clientes.id_clientes";
                    }
                }else{

                $whereArray[] ="producto_final.activo = 1 AND ".$rule ->field." like '%".$rule->data."%' AND producto_final.activo = 1 AND resistencia_mprima.id_resistencia_mprima=producto_final.resistencia AND producto_final.id_cliente=clientes.id_clientes";
                }
            }
            if (count($whereArray)>0) {

                $where .= join(" and ", $whereArray);
            } else {
                $where = "resistencia_mprima.id_resistencia_mprima=producto_final.resistencia AND producto_final.id_cliente=clientes.id_clientes";
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
    // var_dump($where);
 $consul = $this->db->query("SELECT
                                        *
                                        FROM
                                        producto_final,
                                        clientes,
                                        resistencia_mprima
                                        where
                                         ".$where);


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
        if ($start < 0){

          $start = 0;
         $data[]=0;
        }else{
        $resultado_catalogo =$this->producto->get_cat_productos_search($where, $sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
          // echo $sidx."____".$sord."_______".$start."____".$limite;
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(4,2)==1) {

                foreach($resultado_catalogo as $row) {
                   $data->rows[$i]['id']=$row->id_catalogo;
                   ///todos lo permisos
                   if (($this->permisos->permisos(4,1)==1)&&($this->permisos->permisos(4,3)==1)){

                        $onclikedit="onclick=edit('".$row->id_catalogo."')";
                        $onclik="onclick=delet('".$row->id_catalogo."')";

                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=picture('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }


                        // permisos solo para editar
                   }elseif (($this->permisos->permisos(4,1)==1)&&($this->permisos->permisos(4,3)==0)) {

                        $onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=picture('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }

                        // permisos solo para eliminar
                   }elseif (($this->permisos->permisos(4,1)==0)&&($this->permisos->permisos(4,3)==1)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        $onclik="onclick=delet('".$row->id_catalogo."')";
                        if ($row->id_archivos!=0) {
                        $picture="onclick=picture_existe('".$row->id_archivos."','".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/add_picture.png" width="18" height="18" /></span>';
                        }else{
                        $picture="onclick=picture('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span><span style=" cursor:pointer" '.$picture.'><img title="Nueva imagen" src="'.base_url().'img/view_picture.png" width="18" height="18" /></span>';
                        }

// sin permisos
                   }elseif (($this->permisos->permisos(4,1)==0)&&($this->permisos->permisos(4,3)==0)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='';

                   }
                   $data->rows[$i]['cell']=array($acciones,
                               $row->nombre_empresa,
                               $row->nombre,
                               $row->largo,
                               $row->ancho,
                               $row->alto,
                               $row->resistencia,
                               $row->corrugado,
                               $row->score,
                               $row->descripcion);
                   $i++;
                }
        }
    }
        // La respuesta se regresa como json
        echo json_encode($data);
}
}

/* End of file producto_final.php */
/* Location: ./application/controllers/producto_final.php */
