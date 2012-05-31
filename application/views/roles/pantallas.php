 <table width="100%" border="0" cellspacing="1" cellpadding="4" bgcolor="#999999">
          <tr>
            <td width="auto" align="left" bgcolor="#87b6d9" class="subtexto15">Nombre</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Alta (o activar) </td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Modificar</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Consultar</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Eliminar</td>
          </tr>
      
<?php
for($i=0; $i<count($pantallas); $i++){ ?>                           
                            <tr>
                              <td align="left" bgcolor="#FFFFFF" class="titulo1ch2"><? echo $pantallas[$i]['nombre']?></td>                              
                              <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":1";?>" value="1" 
						<? for($j=0; $j<count($rol); $j++){
									if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
									if($rol[$j]['permiso'][0]==1){
										echo "checked";
										}					
					     			}
								}?>></td>
                              <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":2";?>" value="1"
						<? for($j=0; $j<count($rol); $j++){
									if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
									if($rol[$j]['permiso'][1]==1){
										echo "checked";
										}
									
									
									}
								}?>
								></td>
                              <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":3";?>" value="1"
						<? for($j=0; $j<count($rol); $j++){
									if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
									if($rol[$j]['permiso'][2]==1){
										echo "checked";
										}
									
									
									}
								}?>></td>
                              <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":4";?>" value="1"
						<? for($j=0; $j<count($rol); $j++){
									if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
									if($rol[$j]['permiso'][3]==1){
										echo "checked";
										}
									
									
									}
							}?>
								></td>				
                            </tr>
                            
                            <? } ?>
</table>