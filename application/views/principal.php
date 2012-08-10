<?php $this->load->view('header');?>
<?php $this->load->view('menu_up');?>
<?php $this->load->view('session_user');?>
<?php $this->load->view('messages');?>
<?php $this->load->view('menu_izquierdo');?>
<div class="content">

				<?php //$this->load->view('login/acceso');?>
				<?php
				if (isset($vista)) {
				 	$this->load->view($vista);
				 }

				?>
			</div>
   		</div>
	</div>
<?php $this->load->view('footer');?>