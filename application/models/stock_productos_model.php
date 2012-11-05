<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stock_productos_model extends CI_Model {

	
public function get_cat_productos($sidx, $sord, $start, $limite)
{
	$oficina=$this->session->userdata('oficina');
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
public function guardar()
{
		$oficina=$this->session->userdata('oficina');
	$id=$this->input->post('catalogo_producto');

	$cantidad=$this->input->post('cantidad');
	
	$query = $this->db->query("SELECT
                                    clientes.nombre_empresa,
                                    catalogo_producto.nombre,
                                    catalogo_producto.largo,
                                    catalogo_producto.ancho,
                                    catalogo_producto.alto,
                                    resistencia_mprima.resistencia,
                                    catalogo_producto.corrugado,
                                    catalogo_producto.score,
                                    catalogo_producto.descripcion
                                    FROM
                                    catalogo_producto ,
                                    resistencia_mprima,
                                    clientes
                                    WHERE
                                    catalogo_producto.activo = 1 AND
                                    catalogo_producto.id_cliente=clientes.id_clientes AND
                                    catalogo_producto.resistencia = resistencia_mprima.id_resistencia_mprima AND
                                	catalogo_producto.id_catalogo = $id ");
        $fila = $query->row();
        $nombre_cliente=$fila->nombre_empresa;
        $nombre=$fila->nombre;
        $largo=$fila->largo;
        $ancho=$fila->ancho;
        $alto=$fila->alto;
        $resistencia=$fila->resistencia;
        $corrugado=$fila->corrugado;
        $score=$fila->score;

        $query2 = $this->db->query("SELECT
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
                                    stock_producto.id_sucursal = $oficina AND
                                    stock_producto.nombre_cliente = '".$nombre_cliente."' AND
                                    stock_producto.nombre = '".$nombre."' AND
                                    stock_producto.largo = '".$largo."' AND
                                    stock_producto.ancho = '".$ancho."' AND
                                    stock_producto.alto = '".$alto."' AND
                                    stock_producto.resistencia = '".$resistencia."' AND
                                    stock_producto.corrugado = '".$corrugado."' AND
                                    stock_producto.score = $score" );
			
       if ($query2->num_rows()> 0) {
       		$fila2 = $query2->row();
       		$cantidad_DB=$fila2->cantidad;
       		$id_catalogo=$fila2->id_catalogo;
       		$resultado=$cantidad_DB+$cantidad;
       		$data1 = array (
        	'cantidad'=>$resultado
        	);
        	$this->db->where('id_catalogo', $id_catalogo);
            $this->db->update('stock_producto', $data1);
            return 1;
       }else{
        $data = array (
        'nombre_cliente'=>$fila->nombre_empresa,
        'nombre'=>$fila->nombre,
        'largo'=>$fila->largo,
        'ancho'=>$fila->ancho,
        'alto'=>$fila->alto,
        'resistencia'=>$fila->resistencia,
        'corrugado'=>$fila->corrugado,
        'score'=>$fila->score,
        'descripcion'=>$fila->descripcion,
        'fecha_ingreso'=>date('y-m-d'),
        'activo'=>1,
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina'),
        'cantidad'=>$cantidad
        );
        $this->db->insert('stock_producto', $data);
        return $this->db->affected_rows();

       }
        


}
public function guardarResta()
{
		$oficina=$this->session->userdata('oficina');
	$id=$this->input->post('Id_stock');

	$cantidad=$this->input->post('cantidadRestar');
	
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
                                    stock_producto.id_sucursal = $oficina AND
                                    stock_producto.id_catalogo = $id ");
        $fila = $query->row();
        $cantidadDB=$fila->cantidad;
        if ($cantidadDB>$cantidad) {
        	$result=$cantidadDB-$cantidad;

      $data = array (
        'nombre_cliente'=>$fila->nombre_cliente,
        'nombre'=>$fila->nombre,
        'largo'=>$fila->largo,
        'ancho'=>$fila->ancho,
        'alto'=>$fila->alto,
        'resistencia'=>$fila->resistencia,
        'corrugado'=>$fila->corrugado,
        'score'=>$fila->score,
        'descripcion'=>$fila->descripcion,
        'fecha_ingreso'=>date('y-m-d'),
        'activo'=>1,
        'id_usuario'=>$this->session->userdata('id'),
        'id_sucursal'=>$this->session->userdata('oficina'),
        'cantidad'=>$cantidad
        );

        $this->db->insert('historial_producto', $data);
        if ($this->db->affected_rows()>0) {
        	$data = array (
        	'cantidad'=>$result
        	);
        	$this->db->where('id_catalogo', $id);
            $this->db->update('stock_producto', $data);
            if ($this->db->affected_rows()>0) {
            	return 1;
            }
            return 0;
        }else{
        	return 0;
        }
    	    
        }else{
        	return 2;
        }
}
}

/* End of file stock_productos_model.php */
/* Location: ./application/models/stock_productos_model.php */
