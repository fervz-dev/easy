 
<!-- accordion -->
 <script>
  $(function() {
    $( "#accordion" ).accordion();
    $('#accordion >div').css('height', '120');
  });
</script>

<?php $menu_="select id_menu, titulo_menu from menu_principal where activo='1' order by id_menu ASC";
  $menu=$this->db->query($menu_);
  $menu=$menu->result_array();
 ?>


 <table width="100%" border="0" cellspacing="1" cellpadding="4" bgcolor="#999999">
          <tr>
            <td width="auto" align="left" bgcolor="#87b6d9" class="subtexto15">Nombre</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Alta (o activar) </td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Modificar</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Consultar</td>
            <td width="11%" align="center" bgcolor="#87b6d9" class="subtexto15">Eliminar</td>
          </tr>
  </table>
  <div id="accordion"> 
<?php for ($d=0; $d <count($menu) ; $d++) { ?>
      
      <h3><a href="#"><?php echo $menu[$d]['titulo_menu']; ?></a></h3>
         <div>
                    <table width="100%" >
        <?php for ($i=0; $i <count($pantallas) ; $i++) { ?>
                   
           <?php if ($menu[$d]['id_menu']==$pantallas[$i]['id_menu']) {?>                          
                            <tr>
                              	<td id="permisos_" width="auto" align="left" bgcolor="#FFFFFF" class="titulo1ch2"><? echo $pantallas[$i]['nombre'];?></td>                              
                              	<td id="permisos_" width="13%" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":1";?>" value="1" 
									<? for($j=0; $j<count($rol); $j++){
												if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
												if($rol[$j]['permiso'][0]==1){
													echo "checked";
													}					
								     			}
											}?>>
								</td>
                              	<td id="permisos_" width="13%" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":2";?>" value="1"
									<? for($j=0; $j<count($rol); $j++){
												if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
												if($rol[$j]['permiso'][1]==1){
													echo "checked";
													}
												
												
												}
											}?>>
								</td>
                              	<td id="permisos_" width="13%" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":3";?>" value="1"
									<? for($j=0; $j<count($rol); $j++){
												if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
												if($rol[$j]['permiso'][2]==1){
													echo "checked";
													}
												
												
												}
											}?>>
								</td>
                              	<td id="permisos_" width="13%" align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":4";?>" value="1"
									<? for($j=0; $j<count($rol); $j++){
												if($rol[$j]['id_pantalla']==$pantallas[$i]['id_pantalla']){
												if($rol[$j]['permiso'][3]==1){
													echo "checked";
													}
												}
										}?>>
								</td>
							</tr>	
                     <?php } ?>                      
                 <?php } ?>
                  </table>
               </div>
     </div>
            <?php } ?>