<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<script type="text/javascript" src="<?php echo base_url();?>js/mainFunctions.js"></script>
<div style=" height:20px; ">
<?php
$messageArray = $this->session->flashdata('message');
//si no esta vacio trae informacion
if(!empty($messageArray)){
	if ($messageArray[0] == '1') {?>
<script type="text/javascript">
	notify('El registro se edito correctamente',500,5000,'aviso');
</script>		
	<?php }elseif($messageArray[0] == '3') {?>
<script type="text/javascript">
		/*alert("<?php var_dump($messageArray); ?>");*/
		notify('El archivos se subio correctamente',500,5000,'aviso');
		</script>
	<?php  }elseif($messageArray[0] == '4') {?>
<script type="text/javascript">
		/*alert("<?php var_dump($messageArray); ?>");*/
		notify('Error al cargar el archivo...',500,5000,'error');
		</script>
	<?php  }

	 }
?>

  
        
        
<div id="mensajes_0" onclick="oculta(this)" style="background-color:#dfeffc; width:100%; cursor:pointer; display:none; color: #FF0000; font-size:12px; font-weight:bold; border: solid 1px #000000;">
<table width="100%" height="20">
<tr>
<td valign="middle" id="mensajes"></td>
</tr>
</table>
</div>
</div>