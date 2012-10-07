<form id="nuevo_usuario" name="nuevo_usuario">
<table width="100%">
<tr>
  <td width="30%"><label id="labelRight">Oficina:</label></td>
  <td width="70%">
    <select name="sucursal" id="sucursal" style="width:133px;">
    <option value="">Seleccione</option>
  <?php foreach($oficina as $suc){?>
  <option value="<?php echo $suc['id_oficina'];?>"><?php echo strtoupper($suc['nombre_oficina']);?></option>
  <?php }?>
    </select>  </td>
</tr>
<tr>
  <td><label id="labelRight">Rol:</label></td>
  <td>
      <select name="rol" id="rol" style="width:133px;">
    <option value="">Seleccione</option>
  <?php foreach($roles as $rol){?>
  <option value="<?php echo $rol['id_roles'];?>"><?php echo strtoupper($rol['nombre_rol']);?></option>
  <?php }?>
    </select>  </td>
</tr>
<tr>
  <td><label id="labelRight">Nombre:</label></td>
  <td><input name="nombre_completo" type="text" id="nombre_completo" size="40"></td>
</tr>
<tr>
<td width="30%"><label id="labelRight">Usuario:</label></td>
<td><input type="text" name="usuario" id="usuario"></td>
</tr>
<tr>
  <td><label id="labelRight">Password:</label></td>
  <td><input name="password" id="password" type="password"></td>
  <td>
      <div onclick="tip('pass')">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
          <li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
            <span class="ui-icon ui-icon-info"></span>
          </li>
        </ul>
      </div>
    </td>
</tr>
<tr>
  <td><label id="labelRight">Repite Password:</label></td>
  <td><input name="password2" id="password2" type="password"></td>
</tr>
<tr>
  <td><label id="labelRight">Email:</label></td>
  <td><input name="email" id="email" type="text"></td>
  <td>
      <div onclick="tip('email')">
        <ul id="icons" class="ui-widget ui-helper-clearfix">
          <li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
            <span class="ui-icon ui-icon-info"></span>
          </li>
        </ul>
      </div>
    </td>
</tr>
</table>
</form>