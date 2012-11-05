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
                                    clientes.nombre_empresa,
                                    catalogo_producto.id_catalogo,
                                    catalogo_producto.nombre,
                                    catalogo_producto.largo,
                                    catalogo_producto.ancho,
                                    catalogo_producto.alto,
                                    resistencia_mprima.resistencia,
                                    catalogo_producto.corrugado,
                                    catalogo_producto.score,
                                    catalogo_producto.descripcion,
                                    catalogo_producto.fecha_ingreso,
                                    catalogo_producto.id_archivos
                                    FROM
                                    catalogo_producto ,
                                    resistencia_mprima,
                                    clientes
                                    WHERE
                                    catalogo_producto.activo = 1 AND
                                    catalogo_producto.id_cliente=clientes.id_clientes AND
                                    catalogo_producto.resistencia = resistencia_mprima.id_resistencia_mprima  ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}

public function get_cat_productos_search($where, $sidx, $sord, $start, $limite)
{
    $query = $this->db->query("SELECT
                                    clientes.nombre_empresa,
                                    catalogo_producto.id_catalogo,
                                    catalogo_producto.nombre,
                                    catalogo_producto.largo,
                                    catalogo_producto.ancho,
                                    catalogo_producto.alto,
                                    resistencia_mprima.resistencia,
                                    catalogo_producto.corrugado,
                                    catalogo_producto.score,
                                    catalogo_producto.descripcion,
                                    catalogo_producto.fecha_ingreso,
                                    catalogo_producto.id_archivos
                                    FROM
                                    catalogo_producto ,
                                    resistencia_mprima,
                                    clientes
                                    ".$where." AND
                                    catalogo_producto.id_cliente=clientes.id_clientes AND
                                    resistencia_mprima.id_resistencia_mprima=catalogo_producto.resistencia  ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}
/////////////////////////////////////extraccion por ID  ///////////////////////////////////////////////
    public function get_id($id)
    {
        $query = $this->db->query("SELECT
								catalogo_producto.id_cliente,
                                catalogo_producto.nombre,
								catalogo_producto.largo,
								catalogo_producto.ancho,
								catalogo_producto.alto,
								catalogo_producto.resistencia,
								catalogo_producto.corrugado,
								catalogo_producto.score,
								catalogo_producto.descripcion
                                FROM
                                catalogo_producto,
                                resistencia_mprima,
                                clientes
                                WHERE
                                catalogo_producto.id_catalogo = $id AND
                                catalogo_producto.id_cliente=clientes.id_clientes AND
                                catalogo_producto.activo = 1 ");
        $fila = $query->row();
          return $fila;
    }
///extraccion imagen
public function get_imagen($id)
    {
        $query = $this->db->query("SELECT
                                    archivo.id_file,
                                    archivo.nombre_archivo
                                    FROM
                                    archivo
                                    WHERE
                                    archivo.activo = 1 AND
                                    archivo.id_file = $id
                                    LIMIT 1
                                    ");
        $fila = $query->row();
          return $fila;
    }

/////////////////////////////////////funcion guardar formulario  ///////////////////////////////////////////////
public function guardar()
   {
        $data = array (
        'id_cliente'=>$this->input->post('clientesdb'),
        'nombre'=>$this->input->post('nombre'),
        'largo'=>$this->input->post('largo'),
        'ancho'=>$this->input->post('ancho'),
        'alto'=>$this->input->post('alto'),
        'resistencia'=>$this->input->post('resistencia'),
        'corrugado'=>$this->input->post('corrugado'),
        'score'=>$this->input->post('score'),
        'descripcion'=>$this->input->post('descripcion'),
        'fecha_ingreso'=>date('y-m-d'),
        'activo'=>1,
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina')
        );
        $this->db->insert('catalogo_producto', $data);
        return $this->db->affected_rows();
   }

public function eliminar($id)
   {
        $data = array('activo' => 0);
                $this->db->where('id_catalogo', $id);
                $this->db->update('catalogo_producto', $data);
                return $this->db->affected_rows();
   }
public function eliminar_imagen($id_file,$id_catalogo)
{
    $data = array('activo' => 0);
     $archivo = array('id_archivos' => '');


            $this->db->where('id_file', $id_file);
            $this->db->update('archivo', $data);

            $this->db->where('id_catalogo', $id_catalogo);
            $this->db->update('catalogo_producto', $archivo);

            return $this->db->affected_rows();
}
public function editar($id)
   {
        $data = array (
        'id_cliente'=>$this->input->post('clientesdb'),
        'nombre'=>$this->input->post('nombre'),
        'largo'=>$this->input->post('largo'),
        'ancho'=>$this->input->post('ancho'),
        'alto'=>$this->input->post('alto'),
        'resistencia'=>$this->input->post('resistencia'),
        'corrugado'=>$this->input->post('corrugado'),
        'score'=>$this->input->post('score'),
        'descripcion'=>$this->input->post('descripcion')
    );

    $this->db->where('id_catalogo', $id);
    $this->db->update('catalogo_producto',$data);
   }

}

/* End of file catalogo_producto_model.php */
/* Location: ./application/controllers/catalogo_producto_model.php */