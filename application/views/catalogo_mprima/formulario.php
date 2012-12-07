<form name="cat_mprima" id="cat_mprima">
<table id="tabla_formulario">
	
	<tr>
		<td><label>Proveedor:</label></td>
		<td><select name="proveedor_id_proveedor"  id="proveedor_id_proveedor" onblur="generateCdigo ()" onchange="generateCdigo ()">
			<option value="">Seleccione...</option>
			<?php foreach ($proveedor as $pvd) { ?>
			<option value="<?php echo $pvd['id_proveedores']; ?>"><?php echo $pvd['nombre_empresa'] ?></option>
			<?php } ?>
		</select>
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Nombre:</label>
		</td>
		<td>
			<input type="text" name="descripcion" id="descripcion" onblur="generateCdigo ()" onchange="generateCdigo ()">
		</td>
	</tr>

	<tr>
		<td><label id="labelRight">Corrugado:</label></td>
		<td><select id="tipo_m" name="tipo_m" onblur="generateCdigo ()" onchange="generateCdigo ()">
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
			<input name="largo" type="text" id="largo" size="35" onblur="generateCdigo ()" onchange="generateCdigo ()">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Ancho:</label>
		</td>
		<td>
			<input name="ancho" type="text" id="ancho" size="35" onblur="generateCdigo ()" onchange="generateCdigo ()">
		</td>
	</tr>

	<tr>
	<td><label id="labelRight">Resistencia:</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima" onchange="generateCdigo ()">
			<option value="">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
			<option value="<?php echo $rst['id_resistencia_mprima']; ?>"><?php echo $rst['resistencia'] ?></option>
			<?php } ?>
		</select>
	</td>
	</tr>
	<tr>
		<td>
			<label id="labelRight">Codigo:</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35" readonly="readonly">
		</td>
	</tr>
</table>
</form>
<script type="text/javascript">
function generateCdigo () {
		tipo_m=$('#tipo_m').val();
		id_proveedor=$('#proveedor_id_proveedor').val();
		largo=$('#largo').val();
		ancho=$('#ancho').val();
		resistencia=$('#resistencia_mprima_id_resistencia_mprima').val();
		corrugado='';

		if (tipo_m=='SENCILLO') {

			corrugado='1C'
		}else if (tipo_m=='DOBLE') {
			corrugado='2C'
		}
		if (resistencia=='') {

			resultResistencia='';

		}else{
			resultResistencia=$('#resistencia_mprima_id_resistencia_mprima option:selected').html();

		}

		if (largo=='') {
			eqs='';
		}else{
			eqs='X';
		}


		codigo='LA'+corrugado+largo+eqs+ancho+'R'+resultResistencia+'P00'+id_proveedor;
		$('#nombre').val(codigo);
}

</script>