<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

	Class Permisos {
		protected $ci;
		function __construct()
		{
			$this->ci =& get_instance();

		}
public function permisosURL($menu,$submenu)
{


            if ($this->permisos_($menu)==1) {

                    if ($this->permisosArray($submenu)==0) {

                        redirect(base_url().'inicio/logout');
                    }
                }else {
                    redirect(base_url().'inicio/logout');
                }



}

   public function permisos_($id_pan){
   		//$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar

        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos ,
                                                pantallas
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                pantallas.id_menu =".$id_pan." AND
                                                permisos.id_pantalla = pantallas.id_pantalla AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status=1 ");
        //$usuarios=$usuario->row_array();
        $usuarios=$usuario->num_rows();
    	//$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuarios==0){ // no hay permiso
            return 0;
        }else{
            return 1;
        }

 		}
        public function permisos($id_pan,$permisos){
        //$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar

        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status = 1 AND
                                                permisos.id_pantalla = ".$id_pan."");
        $usuarios=$usuario->row_array();

        //$usuariosArray=$usuario->num_rows();
        //$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuarios['permiso'][$permisos]==0){ // no hay permiso
            return 0;
        }else{
            return 1;
        }

        }
        public function permisosArrayURL($id_pan){
        //$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar

        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status = 1 AND
                                                permisos.id_pantalla = ".$id_pan."");
       ;

        //$usuariosArray=$usuario->num_rows();
        //$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuario->num_rows()>0){ // no hay permiso
            return 1;
        }else{
            return 0;
        }

        }
        ///////////verifica si existe por lo menos un submenu activo para el usuario y presente el menu///////
        public function permisosArray($id_pan){
        //$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar

        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status = 1 AND
                                                permisos.id_pantalla = ".$id_pan."");
       ;

        //$usuariosArray=$usuario->num_rows();
        //$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuario->num_rows()>0){ // no hay permiso
            return 1;
        }else{
            return 0;
        }

        }
////verifica si el submenu por lo menos tiene un permisos para ser ejecutado///////

         public function permisos_submenusURL($submenu){
        //$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar
        // $ext_idPan=$this->ci->db->query("SELECT
        //                                 submenus.id_submenu
        //                                 FROM
        //                                 submenus
        //                                 WHERE
        //                                 submenus.id_menu=".$id_pan." AND
        //                                 submenus.id_submenu=".$submenu."");
        // $id_pantalla=$ext_idPan->row_array();
        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status = 1 AND
                                                permisos.id_pantalla = ".$submenu."");
       // $usuarios=$usuario->row_array();

        //$usuariosArray=$usuario->num_rows();
        //$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuario->num_rows()>0){ // si hay permiso
            return 1;
        }else{
            return 0;
        }

        }
        public function permisos_submenus($id_pan, $submenu, $permisos){
        //$this->ci->load->model('permisos_model','permisos');
        //id_pantalla $a,
        //$b=status permiso
        //0 alta
        //1 Modificar
        //2 Cobnsultar
        //3 elminar
        $ext_idPan=$this->ci->db->query("SELECT
                                        submenus.id_submenu
                                        FROM
                                        submenus
                                        WHERE
                                        submenus.id_menu=".$id_pan." AND
                                        submenus.id_submenu=".$submenu."");
        $id_pantalla=$ext_idPan->row_array();
        $usuario = $this->ci->db->query("SELECT
                                                permisos.permiso
                                                FROM
                                                usuarios ,
                                                permisos
                                                WHERE
                                                usuarios.id=".$this->ci->session->userdata('id')." AND
                                                usuarios.id_roles = permisos.id_roles AND
                                                permisos.status = 1 AND
                                                permisos.id_pantalla = ".$id_pantalla['id_submenu']."");
        $usuarios=$usuario->row_array();

        //$usuariosArray=$usuario->num_rows();
        //$usuario=$this->ci->permisos->get_permisos($id_pan);

        if($usuarios['permiso'][$permisos]==0){ // no hay permiso
            return 0;
        }else{
            return 1;
        }

        }
	}

 ?>