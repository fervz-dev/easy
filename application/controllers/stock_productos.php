<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Stock_productos extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		$this->load->model('catalogo_producto_model','producto');
        $this->load->model('resistencia_mprima_model','resistencia');
        $this->load->model("clientes_model","clientes_");
        $this->load->model("stock_productos_model","stock_productos");

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
	        $data['resistencia']=$this->resistencia->get_resistencia_mprima_all();
	        $data['vista']='stock_productos/index';
	        $data['titulo']='Stock de Productos';
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
                                        stock_producto
                                        WHERE
                                        stock_producto.activo = "1"');
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
        $resultado_catalogo =$this->stock_productos->get_cat_productos($sidx, $sord, $start, $limite);
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

	// funcion para guardar formulario
public function guardar()
    {
        $save=$this->stock_productos->guardar();
        echo $save;
    }
    public function guardarResta()
    {
        $save=$this->stock_productos->guardarResta();
        echo $save;
    }

	}
	
	/* End of file stock_productos.php */
	/* Location: ./application/controllers/stock_productos.php */
		