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
                                    AND cprima.cantidad >0 

                                    AND cprima.id_sucursal =".$this->session->userdata('oficina')."
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
                                        -- cat_mprima.peso,
                                        cat_mprima.cantidad,
                                        cat_mprima.peso_total,
                                        cat_mprima.tipoIngreso,
                                        cat_mprima.pesoLamina,
                                        cat_mprima.pesoMuestra,
                                        cat_mprima.cantidad_ultima

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
            $nombre=$this->input->post('nombre');
            $ancho=$this->input->post('ancho');
            $largo=$this->input->post('largo');
            $resistencia_mprima_id_resistencia_mprima=$this->input->post('resistencia_mprima_id_resistencia_mprima');
            $resistencia_=$this->input->post('resistencia_mprima_id_resistencia_mprima');
            $tipo='reutilizable';
            $tipo_m=$this->input->post('tipo_m');
            $peso=$this->input->post('peso');
            $cantidad=$this->input->post('cantidad');
            $peso_total=$this->input->post('peso_total');
            $restan=$this->input->post('cantidad');
            $tipoIngreso=$this->input->post('tipoIngreso');
            $pesoLamina=$this->input->post('pesoLamina');
            $pesoMuestra=$this->input->post('pesoMuestra');
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
                                        cat_mprima_reutilizable.id_cat_mprima,
                                        cat_mprima_reutilizable.pesoLamina,
                                        cat_mprima_reutilizable.pesoMuestra,
                                        cat_mprima_reutilizable.cantidad_ultima                                        
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

            $cantidad_db=$respuesta->cantidad;

            if ($cantidad_db>$cantidad && $tipoIngreso=='1') {

                $dimenciones=$largo*$ancho;
                $resultado_final=$this->ingresoDefault($dimenciones, $resistencia_, $tipo_m, $cantidad);
                $resultado_editar=$cantidad_db-$cantidad;
                $peso_total_db=$respuesta->peso_total;
                $result=$peso_total_db-$resultado_final;
                $data = array (
                            'cantidad'=>$resultado_editar,
                            'peso_total'=>$result,
                            'cantidad_ultima'=>$cantidad
                            );
                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }elseif ($cantidad_db>$cantidad && $tipoIngreso=='2') {

                $ultima_cantidad=$respuesta->cantidad_ultima;
                $peso_total_db=$respuesta->peso_total;
                $resultado_editar=$cantidad_db-$cantidad;
                $pesoLaminadb=$respuesta->pesoLamina;
                $resultado_pesoLamina=$pesoLaminadb*$ultima_cantidad;
                $resultado_cantidad_editar=$peso_total_db-$resultado_pesoLamina;


                $data = array (
                            'cantidad'=>$resultado_editar,
                            'peso_total'=>$resultado_cantidad_editar
                            );

                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }
            elseif ($cantidad_db<$cantidad && $tipoIngreso=='1') {
                 $peso_total_db=$respuesta->peso_total;
                $dimenciones=$largo*$ancho;
             $resultado_editar1=$cantidad-$cantidad_db;
             $resultado_editar=$cantidad_db+$resultado_editar1;
             $resultado_final=$this->ingresoDefault($dimenciones, $resistencia_, $tipo_m, $resultado_editar1);

                $resultado_pesoDefault=$peso_total_db+$resultado_final;

                 $data = array (
                            'cantidad'=>$resultado_editar,
                            'peso_total'=>$resultado_pesoDefault,
                            'cantidad_ultima'=>$cantidad
                            );

                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }elseif ($cantidad_db<$cantidad && $tipoIngreso=='2') {
                
                $ultima_cantidad=$respuesta->cantidad_ultima;

                $peso_total_db=$respuesta->peso_total;
                $pesoLaminadb=$pesoLamina;

                $resultado_pesoLamina=$pesoLaminadb*$ultima_cantidad;
                $resultado_cantidad_editar=$peso_total_db+$resultado_pesoLamina;
                $resultado_editar1=$cantidad-$cantidad_db;
                $resultado_editar=$cantidad_db+$resultado_editar1;
                $data = array (
                    'cantidad'=>$resultado_editar,
                    'peso_total'=>$resultado_cantidad_editar,
                    'tipoIngreso'=>'2',
                    'pesoLamina'=>$pesoLamina,
                    'pesoMuestra'=>$pesoMuestra,
                    'cantidad_ultima'=>$resultado_editar1
                        );

                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }elseif ($cantidad_db>$cantidad && $tipoIngreso=='3') {

                $dimenciones=$largo*$ancho;
                $resultado_final=$this->ingresoDefaultMuestra($dimenciones, $resistencia_, $tipo_m, $cantidad,$pesoMuestra);
                $resultado_editar=$cantidad_db-$cantidad;
                $peso_total_db=$respuesta->peso_total;
                $result=$peso_total_db-$resultado_final;
                $data = array (
                            'cantidad'=>$resultado_editar,
                            'peso_total'=>$result,
                            'tipoIngreso'=>'3',
                            'pesoLamina'=>$pesoLamina,
                            'pesoMuestra'=>$pesoMuestra,
                            'cantidad_ultima'=>$cantidad
                            );
                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }elseif ($cantidad_db<$cantidad && $tipoIngreso=='3') {
                                $peso_total_db=$respuesta->peso_total;
                $dimenciones=$largo*$ancho;
             $resultado_editar1=$cantidad-$cantidad_db;
             $resultado_editar=$cantidad_db+$resultado_editar1;
             $resultado_final=$this->ingresoDefaultMuestra($dimenciones, $resistencia_, $tipo_m, $resultado_editar1, $pesoMuestra);

                $resultado_pesoDefault=$peso_total_db+$resultado_final;

                 $data = array (
                            'cantidad'=>$resultado_editar,
                            'peso_total'=>$resultado_pesoDefault,
                            'tipoIngreso'=>'3',
                            'pesoLamina'=>$pesoLamina,
                            'pesoMuestra'=>$pesoMuestra,
                            'cantidad_ultima'=>$cantidad
                            );

                $this->db->where('id_cat_mprima', $id);
                $this->db->update('cat_mprima_reutilizable',$data);
            }
        }else{
            // $cantidadDB=$respuesta->cantidad;
            // $UltimaCantidadDB=$respuesta->cantidad_ultima;
            // $largoDB=$respuesta->largo;  
            // $anchoDB=$respuesta->ancho;

            // $dimenciones=$largoDB*$anchoDB;

            // if ($cantidadDB>$UltimaCantidadDB && $tipoIngreso=='1') {

            //      $resultado_editar=$cantidadDB-$UltimaCantidadDB;
            //      $resultado_final=$this->ingresoDefault($dimeciones, $resistencia_, $tipo_m, $resultado_editar);
            //      $resultado_pesoDefault=$peso_total_db-$resultado_final;
            //      $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            // }elseif ($cantidadDB<$UltimaCantidadDB && $tipoIngreso=='1') {
            //     $resultado_editar=$UltimaCantidadDB-$cantidadDB;
            //     $resultado_final=$this->ingresoDefault($dimeciones, $resistencia_, $tipo_m, $resultado_editar);
            //     $resultado_pesoDefault=$peso_total_db-$resultado_final;
            //     $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            
            // }elseif ($cantidadDB>$UltimaCantidadDB && $tipoIngreso=='2') {
            //         $pesoLaminadb=$respuesta->pesoLamina;
            //         $ultima_cantidad=$respuesta->cantidad_ultima;

            //         $resultado_pesoLamina=$pesoLaminadb*$ultima_cantidad;

            //         $resultado_editar=$cantidadDB-$UltimaCantidadDB;
               
            //         $resultado_pesoDefault=$peso_total_db-$resultado_pesoLamina;
            //         $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            
            // }elseif ($cantidadDB<$UltimaCantidadDB && $tipoIngreso=='2') {

            //         $pesoLaminadb=$respuesta->pesoLamina;
            //         $ultima_cantidad=$respuesta->cantidad_ultima;

            //         $resultado_pesoLamina=$pesoLaminadb*$ultima_cantidad;

            //         $resultado_editar=$UltimaCantidadDB-$cantidadDB;
               
            //         $resultado_pesoDefault=$peso_total_db-$resultado_pesoLamina;
            //         $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            
            // }elseif ($cantidadDB>$UltimaCantidadDB && $tipoIngreso=='3') {

            //      $resultado_editar=$cantidadDB-$UltimaCantidadDB;
            //      $resultado_final=$this->ingresoDefaultMuestra($dimeciones, $resistencia_, $tipo_m, $resultado_editar,$pesoMuestra);
            //      $resultado_pesoDefault=$peso_total_db-$resultado_final;
            //      $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            
            // }elseif ($cantidadDB<$UltimaCantidadDB && $tipoIngreso=='3') {
            //     $resultado_editar=$UltimaCantidadDB-$cantidadDB;
            //     $resultado_final=$this->ingresoDefault($dimeciones, $resistencia_, $tipo_m, $resultado_editar);
            //     $resultado_pesoDefault=$peso_total_db-$resultado_final;
            //     $cantidadRest=0;
            //          $data = array (
            //                     'cantidad'=>$resultado_editar,
            //                     'peso_total'=>$resultado_pesoDefault,
            //                     'cantidad_ultima'=>$cantidadRest
            //                     );
            //         $this->db->where('id_cat_mprima', $id);
            //         $this->db->update('cat_mprima_reutilizable',$data);
            
            // }
            //
            $this->guardar();
        }


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
    $resultFinal3='';
    $resultado_final='';
        $nombre=$this->input->post('nombre');
        $ancho=$this->input->post('ancho');
        $largo=$this->input->post('largo');
        $resistencia_mprima_id_resistencia_mprima=$this->input->post('resistencia_mprima_id_resistencia_mprima');
        $resistencia_=$this->input->post('resistencia_mprima_id_resistencia_mprima');
        $tipo='reutilizable';
        $tipo_m=$this->input->post('tipo_m');
        $peso=$this->input->post('peso');
        $cantidad=$this->input->post('cantidad');
        $peso_total=$this->input->post('peso_total');
        $restan=$this->input->post('cantidad');
        $tipoIngreso=$this->input->post('tipoIngreso');
        $pesoLamina=$this->input->post('pesoLamina');
        $pesoMuestra=$this->input->post('pesoMuestra');
        $activo=1;
        $id_usuario=$this->session->userdata('id');
        $id_sucursal=$this->session->userdata('oficina');

        if ($tipoIngreso=='2') {
            $resultFinal3=$pesoLamina*$cantidad;
            $resultado_final=number_format($resultFinal3,3);

        }elseif ($tipoIngreso=='3') {
            $resultDimenciones=$largo*$ancho;
            $pesoFloat=(float)$pesoMuestra;
            $resultFinal3=($resultDimenciones/100)*$pesoFloat;
            $resultadoCantidad=$resultFinal3*$cantidad;
            $resultado_final=number_format($resultadoCantidad,3);

        }elseif($tipoIngreso=='1') {
            $dimenciones=$largo*$ancho;
           $resultado_final=$this->ingresoDefault($dimenciones, $resistencia_mprima_id_resistencia_mprima, $tipo_m, $cantidad);
        }

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

            $result=$resultado_final+$peso_total_db;
            $result_cantidad=$cantidad+$cantidad_db;
            $result_restan=$restan_db+$cantidad;


            $data= array ('cantidad'=>$result_cantidad,'peso_total'=>$result,'restan'=>$result_restan,'tipoIngreso'=>$tipoIngreso,'pesoLamina'=>$pesoLamina,'pesoMuestra'=>$pesoMuestra,'cantidad_ultima'=>$cantidad);
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
                'peso'=>'',
                'cantidad'=>$this->input->post('cantidad'),
                'peso_total'=>$resultado_final,
                'restan'=>$this->input->post('cantidad'),
                'activo'=>1,
                'id_usuario'=>$this->session->userdata('id'),
                'id_sucursal'=>$this->session->userdata('oficina'),
                'fecha_ingreso'=>date('y-m-d'),
                'tipoIngreso'=>$this->input->post('tipoIngreso'),
                'pesoLamina'=>$this->input->post('pesoLamina'),
                'pesoMuestra'=>$this->input->post('pesoMuestra'),
                'cantidad_ultima'=>$this->input->post('cantidad')
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
   /*Funcion ingreso default
    *retorna el resultado de la muestra
    * 
    */
   public function ingresoDefault($resultDimenciones,$resistencia_,$tipo_m,$cantidadFormulario)
   {
            if ($resistencia_=='1') {
                $result=(($resultDimenciones/100)*0.003)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='2' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.003)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='2' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*0.006)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='3' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.004)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='3' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*0.006)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='4' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.004)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='4' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*0.007)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='5' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.005)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='5' && $tipo_m=='DOBLE') {
                $result=(($resultDimenciones/100)*0.009)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='6' && $tipo_m=='SENCILLO') {
                $result=(($resultDimenciones/100)*0.010)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='6' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*0.011)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='7' && $tipo_m=='SENCILLO' ) {
                  $result=(($resultDimenciones/100)*0.009)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='7' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*0.011)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='8' && $tipo_m=='SENCILLO') {
                $result=(($resultDimenciones/100)*0.009)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='8' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*0.014)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='9' && $tipo_m=='SENCILLO') {
                $result=(($resultDimenciones/100)*0.009)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='9' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*0.015)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='10' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.09)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='10' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*0.016)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='11' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*0.012)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='11' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*0.018)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }
            return $resultado_final;
   }
    public function ingresoDefaultMuestra($resultDimenciones,$resistencia_,$tipo_m,$cantidadFormulario,$pesoMuestra)
   {
            if ($resistencia_=='1') {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);
            }elseif ($resistencia_=='2' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='2' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='3' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='3' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='4' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='4' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='5' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='5' && $tipo_m=='DOBLE') {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='6' && $tipo_m=='SENCILLO' ) {
                $resultDefault=($resultDimenciones/100)*$pesoMuestra;
                $resultFinal3=$resultDefault*$cantidad;
                $resultado_final=number_format($resultFinal3,3);

            }elseif ($resistencia_=='6' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='7' && $tipo_m=='SENCILLO' ) {
                $resultDefault=($resultDimenciones/100)*$pesoMuestra;
                $resultFinal3=$resultDefault*$cantidad;
                $resultado_final=number_format($resultFinal3,3);

            }elseif ($resistencia_=='7' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='8' && $tipo_m=='SENCILLO') {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='8' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='9' && $tipo_m=='SENCILLO') {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='9' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='10' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='10' && $tipo_m=='DOBLE' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='11' && $tipo_m=='SENCILLO' ) {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }elseif ($resistencia_=='11' && $tipo_m=='DOBLE')  {
                $result=(($resultDimenciones/100)*$pesoMuestra)*$cantidadFormulario;
                $resultado_final=number_format($result,3);

            }
            return $resultado_final;
   }
}
?>
