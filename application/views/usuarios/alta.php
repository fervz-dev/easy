<table width="100%">
<tr>
  <td width="30%">Sucursal:</td>
  <td width="70%">
    <select name="sucursal" id="sucursal" style="width:133px;">
    <option value="0">Seleccione</option>
  <?php foreach($oficina as $suc){?>
  <option value="<?php echo $suc['id_oficina'];?>"><?php echo strtoupper($suc['nombre_oficina']);?></option>
  <?php }?>
    </select>  </td>
</tr>
<tr>
  <td>Rol:</td>
  <td>
      <select name="rol" id="rol" style="width:133px;">
    <option value="0">Seleccione</option>
  <?php foreach($roles as $rol){?>
  <option value="<?php echo $rol['id_roles'];?>"><?php echo strtoupper($rol['nombre_rol']);?></option>
  <?php }?>
    </select>  </td>
</tr>
<tr>
  <td>Nombre:</td>
  <td><input name="nombre_completo" type="text" id="nombre_completo" size="40"></td>
</tr>
<tr>
<td width="30%">Usuario:</td>
<td><label>
  <input type="text" name="usuario" id="usuario">
</label></td>
</tr>
<tr>
  <td>Password:</td>
  <td><input name="password" id="password" type="password"><div id="msg_password"></div></td>
</tr>
<tr>
  <td>Repirte Password:</td>
  <td><input name="password2" id="password2" type="password"></td>
</tr>
<tr>
  <td>Email:</td>
  <td><input name="email" id="email" type="text"></td>
</tr>
</table>
