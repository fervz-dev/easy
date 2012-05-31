<form id="form1" name="form1" method="post"  />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <input name="bandera" value="1" type="hidden" />
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="14%" align="left" class="texto1">Nombre de Rol *</td>
        <td width="86%" align="left"><input type="text" id="nombre" name="nombre" class="Estilo6" size="40" />
        </td>
      </tr>
      <tr>
        <td align="left" class="texto1">Descripci&oacute;n *</td>
        <td align="left"><textarea id="descripcion" name="descripcion" title="*" class="textbox" cols="40" ></textarea>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left"><span class="titulo3ch">Permisos sobre modulo<br />
            </span></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">
        <div id="respuesta_permisos">
        
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
          <tr >
            <td align="left" bgcolor="#FFFFFF" class="titulo1ch2"><? echo $pantallas[$i]['nombre'];?></td>
            <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":1";?>" value="1"></td>
            <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":2";?>" value="1"></td>
            <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":3";?>" value="1"></td>
            <td  align="center" bgcolor="#FFFFFF"><input type="checkbox" name="pantalla<? echo $pantallas[$i]['id_pantalla'].":4";?>" value="1"></td>
          </tr>
          <? } ?>
          
          
        </table>
        
        </div>
        </td>
      </tr>
      <tr>
        <td height="21" align="left"><br /></td>
        <td width="3%">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>