<?php 
$query="SELECT
usuarios.nombre,
oficina.nombre_oficina
from usuarios, oficina
WHERE
usuarios.id = ".$this->session->userdata('id')." AND
usuarios.oficina_id_oficina = ".$this->session->userdata('oficina')."";
$query=$this->db->query($query);
$query=$query->row();
?>
<!-- Nombre de Usuario -->
    	<div class="login-admin-B">
        	<div class="login-admin-A">
            	<div id="login-admin">
                	<span class="name"><strong>USUARIO:</strong> <?php echo strtoupper($query->nombre);?>,<strong> NAVE:</strong> <?php echo strtoupper($query->nombre_oficina);?> </span><a class="logout" href="<?php echo base_url();?>inicio/logout">Log Out</a>
                </div>
            </div>
        </div>
 	</div><!--/header -->