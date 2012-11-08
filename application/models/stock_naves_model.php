<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_naves_model extends CI_Model {


public function get_stock_lista($sidx, $sord, $start, $limite, $oficina)
	{
		$query = $this->db->query("SELECT
									stock_linea.id_stock_linea,
									stock_linea.nombre,
									stock_linea.ancho,
									stock_linea.largo,
									stock_linea.corrugado,
									stock_linea.resistencia,
									stock_linea.cantidad
									FROM
									stock_linea
									WHERE stock_linea.id_sucursal =".$oficina."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}

public function get_stock_lista_search($where, $sidx, $sord, $start, $limite)
	{
		$query = $this->db->query("SELECT
									stock_linea.id_stock_linea,
									stock_linea.nombre,
									stock_linea.ancho,
									stock_linea.largo,
									stock_linea.corrugado,
									stock_linea.resistencia,
									stock_linea.cantidad
									FROM
									stock_linea
									".$where."
									ORDER BY $sidx $sord
									LIMIT $start, $limite;"
									);
		return ($query->num_rows()> 0)? $query->result() : NULL;
	}
 public function get_cat_mprima($sidx, $sord, $start, $limite, $oficina)
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
                                    AND cprima.cantidad >0 

                                    AND cprima.id_sucursal =".$oficina."
                                    ORDER BY $sidx $sord
                                    LIMIT $start, $limite;");
                                return ($query->num_rows() > 0)? $query->result() : NULL;
    }

    public function get_cat_productos($sidx, $sord, $start, $limite, $oficina)
{
	$query = $this->db->query("SELECT
                                    stock_producto.nombre_cliente,
                                    stock_producto.id_catalogo,
                                    stock_producto.nombre,
                                    stock_producto.largo,
                                    stock_producto.ancho,
                                    stock_producto.alto,
                                    stock_producto.resistencia,
                                    stock_producto.corrugado,
                                    stock_producto.score,
                                    stock_producto.descripcion,
                                    stock_producto.cantidad
                                    FROM
                                    stock_producto
                                    WHERE
                                    stock_producto.activo = 1 AND
                                    stock_producto.id_sucursal = $oficina
                                    ORDER BY $sidx $sord
                                LIMIT $start, $limite;");
    return ($query->num_rows() > 0)? $query->result() : NULL;
}


 public function get_cat_mprima_search($where, $sidx, $sord, $start, $limite)
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
            ".$where." AND resistencia.id_resistencia_mprima=cprima.resistencia_mprima_id_resistencia_mprima

            AND cprima.tipo = 'reutilizable'
            AND cprima.cantidad >0
            ORDER BY $sidx $sord
            LIMIT $start, $limite;");
            return ($query->num_rows() > 0)? $query->result() : NULL;
    }
}

/* End of file stock_naves_model.php */
/* Location: ./application/models/stock_naves_model.php */
