<?php

class Catalogo_mprima_model extends CI_Model
{

    function __construct()
{
	parent::__construct();
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function get_cat_mprima($sidx, $sord, $start, $limite)
    {
        $query = $this->db->query("SELECT cprima.id_cat_mprima,
                                    cprima.nombre,
                                    cprima.tipo_m,
                                    cprima.ancho,
                                    cprima.largo,
                                    resistencia.resistencia
                                    FROM cat_mprima AS cprima, resistencia_mprima AS resistencia
                                    WHERE resistencia.id_resistencia_mprima=cprima.resistencia_mprima_id_resistencia_mprima
                                    AND cprima.activo = 1
                                    ORDER BY $sidx $sord
                                    LIMIT $start, $limite;");
                                return ($query->num_rows() > 0)? $query->result() : NULL;
    }
////////////////Extraccion de las resistencias/////////////////////////////////////////////////////////////////////////////////////////
public function get_resistencia_all()
{
    $query = $this->db->query("SELECT
                                    resistencia_mprima.resistencia,
                                    resistencia_mprima.id_resistencia_mprima
                                    FROM
                                    resistencia_mprima
                                    WHERE
                                    resistencia_mprima.activo = 1"
                            );
    return ($query->num_rows() > 0)? $query->result_array() : NULL;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function get_id($id)
    {
        $query = $this->db->query("SELECT
                                        cat_mprima.nombre,
                                        cat_mprima.tipo_m,
                                        cat_mprima.ancho,
                                        cat_mprima.largo,
                                        cat_mprima.resistencia_mprima_id_resistencia_mprima
                                        FROM
                                        cat_mprima,
                                        resistencia_mprima
                                        WHERE
                                        cat_mprima.id_cat_mprima = $id AND
                                        cat_mprima.activo = 1 AND
                                        resistencia_mprima.activo = 1
                                        GROUP BY
                                        cat_mprima.id_cat_mprima
                                        ORDER BY
                                        cat_mprima.nombre ASC");
        $fila = $query->row();
          return $fila;
    }

   public function editar($id)
   {
        $data = array (
        'nombre'=>$this->input->post('nombre'),
        'ancho'=>$this->input->post('ancho'),
        'largo'=>$this->input->post('largo'),
        'resistencia_mprima_id_resistencia_mprima'=>$this->input->post('resistencia_mprima_id_resistencia_mprima'),
        'tipo_m'=>$this->input->post('tipo_m')
    );

    $this->db->where('id_cat_mprima', $id);
    $this->db->update('cat_mprima',$data);
   }

   public function eliminar($id)
   {
        $data = array('activo' => 0);
                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima', $data);
                return $this->db->affected_rows();
   }

      public function guardar()
   {
        $data = array (
        'nombre'=>$this->input->post('nombre'),
        'ancho'=>$this->input->post('ancho'),
        'largo'=>$this->input->post('largo'),
        'resistencia_mprima_id_resistencia_mprima'=>$this->input->post('resistencia_mprima_id_resistencia_mprima'),
        'tipo_m'=>$this->input->post('tipo_m'),
        'activo'=>1,
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina')
        );
        $this->db->insert('cat_mprima', $data);
        return $this->db->affected_rows();
   }

}
?>
