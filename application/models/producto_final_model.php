<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_final_model extends CI_Model {

	public function get_cat_productos($sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
	                                    clientes.nombre_empresa,
	                                    producto_final.id_productoFinal,
	                                    producto_final.nombre,
	                                    producto_final.descripcion
	                                    FROM
	                                    producto_final,
	                                    clientes
	                                    WHERE
	                                    producto_final.activo = 1 AND
	                                    producto_final.id_cliente=clientes.id_clientes
	                                    ORDER BY $sidx $sord
	                                LIMIT $start, $limite;");
	    return ($query->num_rows() > 0)? $query->result() : NULL;
	}

/////////////////////////////////////funcion guardar formulario  ///////////////////////////////////////////////
	public function guardar()
   {
        $data = array (
        'id_cliente'=>$this->input->post('clientesdb'),
        'nombre'=>$this->input->post('nombre'),
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
                $this->db->where('id_productoFinal', $id);
                $this->db->delete('producto_final');
                return $this->db->affected_rows();
   }

       public function get_id($id)
    {
        $query = $this->db->query("SELECT
										producto_final.id_cliente,
	                                    producto_final.nombre,
	                                    producto_final.descripcion
	                                    FROM
	                                    producto_final
	                                    WHERE
	                                    producto_final.activo = 1 AND
                                		producto_final.id_productoFinal = $id ");
        $fila = $query->row();
          return $fila;
    }
}

/* End of file producto_final_model.php */
/* Location: ./application/models/producto_final_model.php */
