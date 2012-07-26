<form name="directorio" id="directorio">
<table>
	<tr>
		<td><label id="labelRight">Estado:</label></td>
		<td><select  name="estado_d" id="estado_d" onchange="cargar_datos_municipios_direccion(this.value);">
			<option value="">Seleccione...</option>
			<?php foreach ($estados as $est) { ?>
			<option value="<?php echo $est['nombre']; ?>"><?php echo $est['nombre'] ?></option>
			<?php } ?>
		</select> 
	</tr>

	<tr>
		<td><label id="labelRight">Municipio:</label></td>
		<td><select id="municipio_d" name="municipio_d" onchange="cargar_datos_localidad_direccion(this.value);"></select></td>
			<td id="ajax_municipio_d"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Localidad:</label></td>
			<td><select id="localidad_d" name="localidad_d"></select></td>
			<td id="ajax_localidad_d"></td>
	</tr>

	<tr>
		<td><label>Direccion</label></td>
		<td><input name="direccion_d" type="text" id="direccion_d" size="35"></td>
	</tr>
	<tr>
		<td><label>Observaciones</label></td>
		<td><input name="comentario_d" type="text" id="comentario_d" size="35"></td>
		<input name="id_direcciones" type="hidden" id="id_direcciones" size="35">

	</tr>	
</table>
</form>