<form name="cat_mprima" id="cat_mprima">
<table>
	<tr>
		<td>
			<label>Nombre</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35">
		</td>
	</tr>

	<tr>
		<td><label>Caracteristica</label></td>
		<td><select id="caracteristica" name="caracteristica">
				<option value="0">Seleccione...</option>
				<option value="SG">SG</option>
				<option value="CORRUGADO">CORRUGADO</option>
			</select>
		</td>
	</tr>

	<tr>
		<td><label>Tipo</label></td>
		<td><select id="tipo" name="tipo">
				<option value="0">Seleccione...</option>
				<option value="LINEA">LINEA</option>
				<option value="REUTILIZABLE">REUTILIZABLE</option>
			</select>
		</td>
	</tr>

		<tr>
	<td><label>Grosor</label></td>
	<td><select id="tipo_m" name="tipo_m">
			<option value="0">Seleccione...</option>

			<option value="sencillo">sencillo</option>
			<option value="doble">doble</option>

		</select> 
	</tr>


	<tr>
		<td>
			<label>Ancho</label>
		</td>
		<td>
			<input name="ancho" type="text" id="ancho" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label>Largo</label>
		</td>
		<td>
			<input name="largo" type="text" id="largo" size="35">
		</td>
	</tr>

	<tr>
	<td><label>Resitencia</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima">
			<option value="0">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
			<option value="<?php echo $rst['id_resistencia_mprima']; ?>"><?php echo $rst['resistencia'] ?></option>
			<?php } ?>
		</select> 
	</tr>
</table>
</form>