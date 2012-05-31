<form name="editar_oficina" id="editar_oficina">
<table>
	<tr>
		<td><label>Oficina</label></td>
		<td><input name="nombre_oficina" type="text" id="nombre_oficina" size="35"></td>
	</tr>

	<tr>
		<td><label>Tipo de Oficina</label></td>
		<td><select  name="tipo_oficina_id_tipo_oficina" id="tipo_oficina_id_tipo_oficina">
			<option value="0">Seleccione...</option>
			<?php foreach ($tipo_oficinas as $tofn) { ?>
			<option value="<?php echo $tofn['id_tipo_oficina']; ?>"><?php echo $tofn['nombre'] ?></option>
			<?php } ?>
		</select> 
	</tr>

	<tr>
		<td><label>Direccion</label></td>
		<td><input name="direccion" type="text" id="direccion" size="35"></td>
	</tr>

	<tr>
		<td><label>Colonia</label></td>
		<td><input name="colonia" type="text" id="colonia" size="35"></td>
	</tr>

	<tr>
		<td><label>Telefono</label></td>
		<td><input name="telefono" type="text" id="telefono" size="35"></td>
	</tr>

	<tr>
		<td><label>RFC</label></td>
		<td><input name="rfc" type="text" id="rfc" size="35"></td>
	</tr>

	<tr>
		<td><label>Ciudad</label></td>
		<td><input name="ciudad" type="text" id="ciudad" size="35"></td>
	</tr>

	<tr>
		<td><label>Estado</label></td>
		<td><select  name="estado_id_estado" id="estado_id_estado">
			<option value="0">Seleccione...</option>
			<?php foreach ($estados as $est) { ?>
			<option value="<?php echo $est['id_estado']; ?>"><?php echo $est['dsc_estado'] ?></option>
			<?php } ?>
		</select>
	</tr>

	<tr>
		<td><label>C.P.</label></td>
		<td><input name="cp" type="text" id="cp" size="35"></td>
	</tr>

	<tr>
		<td><label>Logo</label></td>
		<td><input name="logo" type="text" id="logo" size="35"></td>
	</tr>

	<tr>
		<td><label>Observaciones</label></td>
		<td><input name="observaciones" type="text" id="observaciones" size="35"></td>
	</tr>

	<tr>
		<td><label>Cordenadas en X</label></td>
		<td><input name="coordx" type="text" id="coordx" size="35"></td>
	</tr>

	<tr>
		<td><label>Coordenadas en Y</label></td>
		<td><input name="coordy" type="text" id="coordy" size="35"></td>
	</tr>
</table>
</form>