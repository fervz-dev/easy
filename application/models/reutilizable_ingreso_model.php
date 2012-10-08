<?php

class Reutilizable_ingreso_model extends CI_Model
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
                                    -- cprima.caracteristica,
                                    -- cprima.tipo,
                                    cprima.tipo_m,
                                    cprima.ancho,
                                    cprima.largo,
                                    resistencia.resistencia,
                                    cprima.peso,
                                    cprima.cantidad,
                                    cprima.peso_total,
                                    cprima.restan

                                    FROM cat_mprima_reutilizable AS cprima, resistencia_mprima AS resistencia
                                    WHERE resistencia.id_resistencia_mprima=cprima.resistencia_mprima_id_resistencia_mprima
                                    AND cprima.activo = 1
                                    AND cprima.tipo = 'reutilizable'
                                    AND cprima.id_sucursal =".$this->session->userdata('oficina')."
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
                                        -- cat_mprima.caracteristica,
                                        -- cat_mprima.tipo,
                                        cat_mprima.tipo_m,
                                        cat_mprima.ancho,
                                        cat_mprima.largo,
                                        cat_mprima.resistencia_mprima_id_resistencia_mprima,
                                        cat_mprima.peso,
                                        cat_mprima.cantidad,
                                        cat_mprima.peso_total
                                        FROM
                                        cat_mprima_reutilizable AS cat_mprima,
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
        // 'caracteristica'=>$this->input->post('caracteristica'),
        'ancho'=>$this->input->post('ancho'),
        'largo'=>$this->input->post('largo'),
        'resistencia_mprima_id_resistencia_mprima'=>$this->input->post('resistencia_mprima_id_resistencia_mprima'),
        'tipo'=>'reutilizable',
        'tipo_m'=>$this->input->post('tipo_m'),
        'peso'=>$this->input->post('peso'),
        'cantidad'=>$this->input->post('cantidad'),
        'peso_total'=>$this->input->post('peso_total'),
        'restan'=>$this->input->post('restan'),
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina')
    );

    $this->db->where('id_cat_mprima', $id);
    $this->db->update('cat_mprima_reutilizable',$data);
   }

   public function eliminar($id)
   {
        $data = array('activo' => 0);
                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable', $data);
                return $this->db->affected_rows();
   }

      public function guardar()
   {
        $nombre=$this->input->post('nombre');
        $ancho=$this->input->post('ancho');
        $largo=$this->input->post('largo');
        $resistencia_mprima_id_resistencia_mprima=$this->input->post('resistencia_mprima_id_resistencia_mprima');
        $tipo='reutilizable';
        $tipo_m=$this->input->post('tipo_m');
        $peso=$this->input->post('peso');
        $cantidad=$this->input->post('cantidad');
        $peso_total=$this->input->post('peso_total');
        $restan=$this->input->post('cantidad');
        $activo=1;
        $id_usuario=$this->session->userdata('id');
        $id_sucursal=$this->session->userdata('oficina');

        $query=$this->db->query("SELECT
                                    cat_mprima_reutilizable.nombre,
                                    cat_mprima_reutilizable.caracteristica,
                                    cat_mprima_reutilizable.ancho,
                                    cat_mprima_reutilizable.largo,
                                    cat_mprima_reutilizable.resistencia_mprima_id_resistencia_mprima,
                                    cat_mprima_reutilizable.tipo,
                                    cat_mprima_reutilizable.tipo_m,
                                    cat_mprima_reutilizable.cantidad,
                                    cat_mprima_reutilizable.peso_total,
                                    cat_mprima_reutilizable.restan,
                                    cat_mprima_reutilizable.id_cat_mprima
                                    FROM
                                    cat_mprima_reutilizable
                                    WHERE
                                    cat_mprima_reutilizable.nombre='".$nombre."' AND
                                    cat_mprima_reutilizable.ancho='".$ancho."' AND
                                    cat_mprima_reutilizable.largo='".$largo."' AND
                                    cat_mprima_reutilizable.resistencia_mprima_id_resistencia_mprima='".$resistencia_mprima_id_resistencia_mprima."' AND
                                    cat_mprima_reutilizable.tipo='".$tipo."' AND
                                    cat_mprima_reutilizable.tipo_m='".$tipo_m."' AND
                                    cat_mprima_reutilizable.id_sucursal='".$id_sucursal."' LIMIT 1");
    $respuesta=$query->row();
            if (count($respuesta)>0) {
            $id_reustilizable=$respuesta->id_cat_mprima;

            $cantidad_db=$respuesta->cantidad;
            $peso_total_db=$respuesta->peso_total;
            $restan_db=$respuesta->restan;

            $result=$peso_total+$peso_total_db;
            $result_cantidad=$cantidad+$cantidad_db;
            $result_restan=$restan_db+$cantidad;

            $data= array ('cantidad'=>$result_cantidad,'peso_total'=>$result,'restan'=>$result_restan);
            $this->db->where('id_cat_mprima',$id_reustilizable);
            $this->db->update('cat_mprima_reutilizable',$data);
            $numero_rows=$this->db->affected_rows();
                if ($numero_rows>0) {
                    return 1;
                    }
        }else{
            $data = array (
                'nombre'=>$this->input->post('nombre'),
                // 'caracteristica'=>$this->input->post('caracteristica'),
                'ancho'=>$this->input->post('ancho'),
                'largo'=>$this->input->post('largo'),
                'resistencia_mprima_id_resistencia_mprima'=>$this->input->post('resistencia_mprima_id_resistencia_mprima'),
                'tipo'=>'reutilizable',
                'tipo_m'=>$this->input->post('tipo_m'),
                'peso'=>$this->input->post('peso'),
                'cantidad'=>$this->input->post('cantidad'),
                'peso_total'=>$this->input->post('peso_total'),
                'restan'=>$this->input->post('cantidad'),
                'activo'=>1,
                'id_usuario'=>$this->session->userdata('id'),
                'id_sucursal'=>$this->session->userdata('oficina'),
                'fecha_ingreso'=>date('y-m-d')
                );
                $this->db->insert('cat_mprima_reutilizable', $data);
                 $numero_rows1=$this->db->affected_rows();
                if ($numero_rows1>0) {
                        return 2;
                    }else{
                        return 3;
                    }

        }

   }
}
?>
