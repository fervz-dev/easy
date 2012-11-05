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
		
	</td>
</tr>
<td colspan="2">
	<fieldset>
		<legend>
			forma de ingresar al sistema
		</legend>
		<table>
			<tr>
				<td>
					<select id="tipoIngreso" name="tipoIngreso">
						<option value="1" onclick="tipo_Ingreso(1);">Default</option>
						<option value="2" onclick="tipo_Ingreso(2);">Por peso Lamina</option>
						<option value="3" onclick="tipo_Ingreso(3);">Por muestra</option>
					</select>
				<!-- Default<input type ="radio" name="tipoIngreso" value="1" checked="checked"onclick="tipo_Ingreso(1);">
				Peso lamina<input type ="radio" name="tipoIngreso" value="2" onclick="tipo_Ingreso(2);">
				Muestra<input type ="radio" name="tipoIngreso" value="3"onclick="tipo_Ingreso(3);"> -->
				</td>
			</tr>

		</table>
	</fieldset>
</td>
			<tr id="tipo1"style="display:none;">
				<td>
					<label id="labelRight">Peso Lamina:</label>
				</td>
				<td>
					<input type="text"	name="pesoLamina" id="pesoLamina">
				</td>
			</tr>

			<tr id="tipo2" style="display:none;">
				<td>
					<label id="labelRight">Peso Muestra:</label>
				</td>
				<td>
					<input type="text"	name="pesoMuestra" id="pesoMuestra">
					<label for="">El tamaño debe de ser:(10cm X 10cm)</label>
				</td>
			</tr>
	<tr>
	<td><label id="labelRight">Resitencia:</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima">
			<option value="">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
				<option value="<?php echo $rst['id_resistencia_mprima'];
				?>"><?php echo $rst['resistencia'] ?></option>
				<?php } ?>
		</select> </td>
	</tr>

<tr>


<!-- <td colspan="2">
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

</td> -->
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
					<!-- <td><input type="button" id="calcular" name="calcular"  value="Calcular" onclick="javascript:calcular1();"></td> -->
					<tr>
<!-- 					<td>
						<input name="peso_total" id="peso_total" type="hidden">
					</td> -->
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
function tipo_Ingreso(radio) {

	if (radio==1) {
		$('#pesoLamina').val("");
		$('#pesoMuestra').val("");
		$('#tipo1').hide();
		$('#tipo2').hide();
	}else if (radio==2) {
		$('#tipo1').show();
		$('#pesoMuestra').val("");
		$('#tipo2').hide();
	}else if (radio==3) {
		$('#pesoLamina').val("");
		$('#tipo1').hide();
		$('#tipo2').show();
	}
}


</script>