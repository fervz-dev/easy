<form name="cat_producto" id="cat_producto">
<table id="tabla_formulario">
	<tr>
		<td>
			<label id="labelRight">Nombre:</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35">
		</td>
	</tr>
	<tr>
		<td>
			<label id="labelRight">Largo:</label>
		</td>
		<td>
			<input name="largo" type="text" id="largo" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Ancho:</label>
		</td>
		<td>
			<input name="ancho" type="text" id="ancho" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Altura:</label>
		</td>
		<td>
			<input name="alto" type="text" id="alto" size="35">
		</td>
	</tr>
<tr>
	<td><label id="labelRight">Resitencia:</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima">
			<option value="">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
			<option value="<?php echo $rst['id_resistencia_mprima']; ?>"><?php echo $rst['resistencia'] ?></option>
			<?php } ?>
		</select>
	</tr>
	<tr>
		<td><label id="labelRight">Corrugado:</label></td>
		<td><select id="tipo_m" name="tipo_m">
			<option value="">Seleccione...</option>

			<option value="SENCILLO">SENCILLO</option>
			<option value="DOBLE">DOBLE</option>

		</select>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Score:</label>
		</td>
		<td>
			<input name="score" type="text" id="score" size="35">
		</td>
	</tr>

		<tr>
		<td>
			<label id="labelRight">Descripcion:</label>
		</td>
		<td>
			<textarea rows="8" cols="32" name="descripcion" id="descripcion">

			</textarea>

		</td>
	</tr>
</table>
</form>