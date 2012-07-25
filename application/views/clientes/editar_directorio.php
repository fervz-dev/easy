<form name="directorio" id="directorio">
<table>
	<tr>
		<td><label>Estado</label></td>
		<td><select  name="estado_id_estado_d" id="estado_id_estado_d">
			<option value="">Seleccione...</option>
			<?php foreach ($estados as $est) { ?>
			<option value="<?php echo $est['id_estado']; ?>"><?php echo $est['dsc_estado'] ?></option>
			<?php } ?>
		</select> 
	</tr>
	<tr>
		<td><label>Ciudad</label></td>
		<td><input name="ciudad_d" type="text" id="ciudad_d" size="35"></td>
	</tr>
	<tr>
		<td><label>Colonia</label></td>
		<td><input name="colonia_d" type="text" id="colonia_d" size="35"></td>
	</tr>

	<tr>
		<td><label>Direccion</label></td>
		<td><input name="direccion_d" type="text" id="direccion_d" size="35"></td>
	</tr>
	<tr>
		<td><label>Observaciones</label></td>
		<td><input name="observaciones_d" type="text" id="observaciones_d" size="35"></td>
		<input name="id_direcciones" type="hidden" id="id_direcciones" size="35">

	</tr>
	<div id="guardar_dir" style="display:none"><tr><td> </td> <td><input name="guardar_dir" type="button" id="guardar_dir" value="Guardar Nuevo" onClick="guardar_nuevo()"/></td></tr></div>
	<div id="guardar_edit" style="display:none"><tr><td> </td> <td><input name="guardar_edit" type="button" id="guardar_edit" value="Guardar editado" onClick="editar_directorio_all()"/></td></tr></div>
	
</table>
</form>