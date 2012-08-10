<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direcciones extends CI_Controller {
public function __construct()
{
   parent::__construct();
   $this->load->model('direcciones_model','direcciones');
   //      if(!$this->redux_auth->logged_in()|| $this->permisos->permisosURL()){//verificar si el el usuario ha iniciado sesion
   //          redirect(base_url().'inicio');
   //      //echo 'denegado';
   //      }
}
    public function index()
    {
    }

    public function municipio($estado)
    {
        $municipios=$this->direcciones->municipios($estado);
        $combo = "";
        $combo= '<option value="">Selecciones...</option>';
        for ($i=0; $i <count($municipios) ; $i++) {
             $combo .= "<option value='".$municipios[$i]["nombre"]."'>".$municipios[$i]["nombre"]."</option>";
        }
        echo $combo;
    }
    public function localidad($municipio)
    {
        $localidades=$this->direcciones->localidades($municipio);
        $combo = "";
        $combo= '<option value="">Selecciones...</option>';
        for ($i=0; $i <count($localidades) ; $i++) {
            $combo .= "<option value='".$localidades[$i]["nombre"]."'>".$localidades[$i]["nombre"]."</option>";
             }
        echo $combo;
    }

}

/* End of file direcciones.php */
/* Location: ./application/controllers/direcciones.php */