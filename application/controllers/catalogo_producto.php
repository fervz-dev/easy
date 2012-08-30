<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo_producto extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->model('catalogo_producto_model','producto');
	   $this->load->model('resistencia_mprima_model','resistencia');
	   //$this->load->model('archivo_model','archivo');

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
    	$data['resistencia']=$this->resistencia->get_resistencia_mprima_all();
    	$data['vista']='catalogo_producto/index';
    	$data['titulo']='Catalogo de Productos';
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
                                        catalogo_producto
                                        WHERE
                                        catalogo_producto.activo = "1"');
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
         $data();
        }else{
        $resultado_catalogo =$this->producto->get_cat_productos($sidx, $sord, $start, $limite);
        // Se agregan los datos de la respuesta del servidor
        $data->page = $page;
        $data->total = $total_pages;
        $data->records = $count;
        $i=0;
if ($this->permisos->permisos(4,2)==1) {

                foreach($resultado_catalogo as $row) {
                   $data->rows[$i]['id']=$row->id_catalogo;

                   if (($this->permisos->permisos(4,1)==1)&&($this->permisos->permisos(4,3)==1)){

                        $onclikedit="onclick=edit('".$row->id_catalogo."')";
                        $onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>&nbsp;<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

                   }elseif (($this->permisos->permisos(4,1)==1)&&($this->permisos->permisos(4,3)==0)) {

                        $onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclikedit.'><img title="Editar" src="'.base_url().'img/edit.png" width="18" height="18" /></span>';

                   }elseif (($this->permisos->permisos(4,1)==0)&&($this->permisos->permisos(4,3)==1)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        $onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='<span style=" cursor:pointer" '.$onclik.'><img src="'.base_url().'img/borrar.png" width="18" title="Eliminar" height="18" /></span>';

                   }elseif (($this->permisos->permisos(4,1)==0)&&($this->permisos->permisos(4,3)==0)) {

                        //$onclikedit="onclick=edit('".$row->id_catalogo."')";
                        //$onclik="onclick=delet('".$row->id_catalogo."')";
                        $acciones='';

                   }
                   $data->rows[$i]['cell']=array($acciones,
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

/* End of file catalogo_producto.php */
/* Location: ./application/controllers/catalogo_producto.php */