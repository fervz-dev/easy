<form name="cat_mprima" id="cat_mprima">
<table>
	<tr>
		<td>
			<label id="labelRight">Nombre:</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35">
		</td>
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
	<td><label id="labelRight">Resitencia:</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima">
			<option value="">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
			<option value="<?php echo $rst['id_resistencia_mprima']; ?>"><?php echo $rst['resistencia'] ?></option>
			<?php } ?>
		</select> </td>
	</tr>

<tr>

<td colspan="2">
	<fieldset>
		<legend>Peso por unidad</legend>
		<table>

			<tr>
				<td>
					<label id="labelRight">Peso:</label>
				</td>
				<td>
					<input name="peso" type="text" id="peso" size="35" > <br />
				</td>
			</tr>
		</table>
	</fieldset>

</td>
</tr>
<tr>
	<td colspan="2">
		<fieldset>
			<legend>Total de laminas</legend>
			<table>
				<tr>
					<td>
						<label id="labelRight">
							Cantidad
						:</label>
					</td>
					<td>
						<input name="cantidad" id="cantidad" type="text" >
					</td>
					<td><input type="button" id="calcular" name="calcular"  value="Calcular" onclick="javascript:calcular1();"></td>
					<tr>
					<td>
						<input name="peso_total" id="peso_total" type="hidden">
					</td>
					</tr>
				</tr>
			</table>
		</fieldset>
	</td>

</tr>
<tr>

</tr>
</table>
</form>

<script type="text/javascript">




</script>