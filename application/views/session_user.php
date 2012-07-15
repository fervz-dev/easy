<?php 
  $query="select * from usuarios where id = ".$this->session->userdata('id');
  $query=$this->db->query($query);
  $query=$query->row();
?>
<!-- Nombre de Usuario -->
    	<div class="login-admin-B">
        	<div class="login-admin-A">
            	<div id="login-admin">
                	<span class="name"><?php echo strtoupper($query->nombre);?></span><a class="logout" href="<?php echo base_url();?>inicio/logout">Log Out</a>
                </div>
                <div id="error">asdasdasdasds</div>

            </div>
        </div>
 	</div><!--/header -->