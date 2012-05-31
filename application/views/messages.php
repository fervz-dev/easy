<?php

$messageArray = $this->session->flashdata('message');
//si no esta vacio trae informacion
if(!empty($messageArray)){
	
	print('	<div class="'.$messageArray['messageType'].'_system ">
			'.$messageArray['Message'].'</div>');
	 }
?>