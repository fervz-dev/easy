<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalogo_producto_model extends CI_Model {

    function __construct()
    {
       parent::__construct();
       //Do your magic here
    }
public function get_cat_productos($sidx, $sord, $start, $limite)
{
	$query = $this->db->query("SELECT
								catalogo_producto.id_catalogo,
								catalogo_producto.nombre,
								catalogo_producto.largo,
								catalogo_producto.ancho,
								catalogo_producto.alto,
								catalogo_producto.resistencia,
								catalogo_producto.corrugado,
								catalogo_producto.score,
								catalogo_producto.descripcion,
								catalogo_producto.fecha_ingreso,
								catalogo_producto.id_archivos
								FROM
								catalogo_producto
								WHERE
								catalogo_producto.activo = 1 ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}

}

/* End of file catalogo_producto_model.php */
/* Location: ./application/controllers/catalogo_producto_model.php */