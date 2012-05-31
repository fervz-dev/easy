<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
?>
<div style=" height:20px; ">
<?php
$messageArray = $this->session->flashdata('message');
//si no esta vacio trae informacion
if(!empty($messageArray)){
	
	print('	<div onclick="oculta(this)" id="msgs" style="background-color:#dfeffc; width:100%; cursor:pointer;  color: #FF0000; font-size:12px; font-weight:bold; border: solid 1px #000000;" class="'.$messageArray['messageType'].'_system "><table width="100%" height="20">
<tr>
<td valign="middle" id="mensajes">

			'.$messageArray['Message'].'</td></tr>
</table></div>');
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