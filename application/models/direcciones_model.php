<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direcciones_model extends CI_Model {

public function __construct()
{
   parent::__construct();
   //Do your magic here
}
public function municipios($estado_)
{
	$estado = urldecode($estado_);
	$query=$this->db->query("SELECT
                        municipios.nombre,
                        municipios.id
                        FROM
                        estados ,
                        municipios
                        WHERE
                        estados.nombre = '".$estado."' AND
                        municipios.estado_id = estados.id");
	return ($query->num_rows()> 0)? $query->result_array() : NULL;
}
public function localidades($municipio_)
{
	$municipio=urldecode($municipio_);
	$query=$this->db->query("SELECT
	                        localidades.nombre
	                        FROM
	                        localidades ,
	                        municipios
	                        WHERE
	                        municipios.nombre = '".$municipio."' AND
	                        localidades.municipio_id = municipios.id");
	return ($query->num_rows()> 0)? $query->result_array() : NULL;
}
public function vialidad()
{
	$query=$this->db->query('SELECT
							tipo_vialidad.id_vialidad,
							tipo_vialidad.vialidad
							FROM
							tipo_vialidad
							ORDER BY
							tipo_vialidad.id_vialidad ASC');
	return($query->num_rows()>0)? $query->result_array():NULL;
}
public function asentamiento()
{
	$query=$this->db->query('SELECT
							tipo_asentamiento.id_asentamiento,
							tipo_asentamiento.asentamiento
							FROM
							tipo_asentamiento
							ORDER BY
							tipo_asentamiento.id_asentamiento ASC');
	return($query->num_rows()>0)? $query->result_array():NULL;
}
public function estados()
{
	$query=$this->db->query('SELECT
							estados.clave,
							estados.nombre
							FROM
							estados
							ORDER BY
							estados.clave ASC');
	return($query->num_rows()>0)? $query->result_array():NULL;
}

 }