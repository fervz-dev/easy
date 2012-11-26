<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_final_model extends CI_Model {

	// public function get_cat_productos($sidx, $sord, $start, $limite)
	// {
	// 	$query = $this->db->query("SELECT
	//                                     clientes.nombre_empresa,
	//                                     producto_final.id_productoFinal,
	//                                     producto_final.nombre_producto,
	//                                     producto_final.descripcion
	//                                     FROM
	//                                     producto_final,
	//                                     clientes
	//                                     WHERE
	//                                     producto_final.activo = 1 AND
	//                                     producto_final.id_cliente=clientes.id_clientes
	//                                     ORDER BY $sidx $sord
	//                                 LIMIT $start, $limite;");
	//     return ($query->num_rows() > 0)? $query->result() : NULL;
	// }
public function get_cat_productos($sidx, $sord, $start, $limite)
{
  $query = $this->db->query("SELECT
                                    clientes.nombre_empresa,
                                    producto_final.id_catalogo,
                                    producto_final.nombre,
                                    producto_final.largo,
                                    producto_final.ancho,
                                    producto_final.alto,
                                    resistencia_mprima.resistencia,
                                    producto_final.corrugado,
                                    producto_final.score,
                                    producto_final.descripcion,
                                    producto_final.fecha_ingreso,
                                    producto_final.id_archivos
                                    FROM
                                    producto_final,
                                    resistencia_mprima,
                                    clientes
                                    WHERE
                                    producto_final.activo = 1 AND
                                    producto_final.id_cliente=clientes.id_clientes AND
                                    producto_final.resistencia = resistencia_mprima.id_resistencia_mprima   ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}
/////////////////////////////////////funcion guardar formulario  ///////////////////////////////////////////////
	public function guardar()
   {
        $data = array (
        'id_cliente'=>$this->input->post('clientesdb'),
        'id_productoFinal'=>$this->input->post('productosBD'),
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
        $this->db->insert('producto_final', $data);
        return $this->db->affected_rows();
   }
   public function eliminar($id)
   {
    $this->db->trans_start();
                $this->db->where('id_catalogo', $id);
                $this->db->delete('producto_final');
                $this->db->where('id_productoFinal', $id);
                $this->db->delete('catalogo_producto');
    $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE)
      {
        return 0;
      }else if ($this->db->trans_status() === TRUE) {
        return 1;
      }
    }

  // public function get_id($id)
  // {
  //     $query = $this->db->query("SELECT
		// 							                 producto_final.id_cliente,
  //                                   producto_final.nombre_producto,
  //                                   producto_final.descripcion
  //                                   FROM
  //                                   producto_final
  //                                   WHERE
  //                                   producto_final.activo = 1 AND
  //                             		producto_final.id_productoFinal = $id ");
  //     $fila = $query->row();
  //       return $fila;
  // }
  public function get_id($id)
  {
    $query = $this->db->query("SELECT
                          producto_final.id_cliente,
                          producto_final.nombre,
                          producto_final.largo,
                          producto_final.ancho,
                          producto_final.alto,
                          producto_final.resistencia,
                          producto_final.corrugado,
                          producto_final.score,
                          producto_final.descripcion
                            FROM
                            producto_final,
                            resistencia_mprima,
                            clientes
                            WHERE
                            producto_final.id_catalogo = $id AND
                            producto_final.id_cliente=clientes.id_clientes AND
                            producto_final.activo = 1 ");
    $fila = $query->row();
      return $fila;
  }
  public function producto($id_cliente)
  {
    $query=$this->db->query("SELECT
                        producto_final.id_catalogo,
                        producto_final.nombre
                        FROM
                        producto_final
                        where
                        producto_final.id_cliente=$id_cliente AND
                        producto_final.activo=1
                        ORDER BY Producto_final.nombre ASC");
      return ($query->num_rows()> 0)? $query->result_array() : NULL;
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

    public function eliminar_imagen($id_file,$id_catalogo)
{
    $data = array('activo' => 0);
     $archivo = array('id_archivos' => '');


            $this->db->where('id_file', $id_file);
            $this->db->update('archivo', $data);

            $this->db->where('id_catalogo', $id_catalogo);
            $this->db->update('producto_final', $archivo);

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
        'descripcion'=>$this->input->post('descripcion'),
        'id_productoFinal'=>$this->input->post('productosBD'),
    );

    $this->db->where('id_catalogo', $id);
    $this->db->update('producto_final',$data);
   }

public function get_cat_productos_search($where, $sidx, $sord, $start, $limite)
{
    $query = $this->db->query("SELECT
                                    clientes.nombre_empresa,
                                    producto_final.id_catalogo,
                                    producto_final.nombre,
                                    producto_final.largo,
                                    producto_final.ancho,
                                    producto_final.alto,
                                    resistencia_mprima.resistencia,
                                    producto_final.corrugado,
                                    producto_final.score,
                                    producto_final.descripcion,
                                    producto_final.fecha_ingreso,
                                    producto_final.id_archivos
                                    FROM
                                    producto_final ,
                                    resistencia_mprima,
                                    clientes
                                    where

                                    ".$where."
                                      ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}

}

/* End of file producto_final_model.php */
/* Location: ./application/models/producto_final_model.php */
