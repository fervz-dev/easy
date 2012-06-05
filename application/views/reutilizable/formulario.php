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
		</select> </td>
	</tr>
		
<tr>

<td colspan="2">
	<fieldset>
		<legend>Peso por unidad</legend>
		<table>
			<tr>
				<td><label>Kilos</label></td>
				<td><select id="kilos" name="kilos">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					</select> 
				</td>
			</tr>
			<tr>
				<td>
					<label>Gramos</label>	
				</td>
				<td>
					<input name="gramos" type="text" id="gramos" size="35" onblur="javascript:sumar();">	
				</td>
			</tr>
			<tr>
				<td>
					<label>Peso</label>
				</td>
				<td>
					<input name="peso" type="text" id="peso" size="35"readonly="readonly" > <br />
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
						<label>
							Cantidad
						</label>
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
function sumar () {
var text1=$("#kilos").val();
var text2=$("#gramos").val();
var text=text1+'.'+text2;
$("#peso").val(text);


}
function calcular1 () {
	var peso_=$("#peso").val();
	var cantidad=$("#cantidad").val();
	var total1=peso_*cantidad;
	var calcu=total1.toFixed(2);
	$("#peso_total").val(calcu);
	alert(calcu);
}


</script>