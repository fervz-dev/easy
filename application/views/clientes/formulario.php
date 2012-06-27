<form name="editar_clientes" id="editar_clientes" >
<table>
	
	<tr>
		<td><label>Nombre Empresa</label></td>
		<td><input name="nombre_empresa" type="text" id="nombre_empresa" size="35"></td>
	</tr>

	<tr>
		<td><label>Contacto</label></td>
		<td><input name="nombre_contacto" type="text" id="nombre_contacto" size="35"></td>
	</tr>

	<tr>
		<td><label>Tipo de persona</label></td>
		<td><input name="tipo_persona" type="text" id="tipo_persona" size="35"></td>
	</tr>

	<tr>
		<td><label>RFC</label></td>
		<td><input name="rfc" type="text" id="rfc" size="35"></td>
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
		<td><label>Ciudad</label></td>
		<td><input name="ciudad" type="text" id="ciudad" size="35"></td>
	</tr>

	<tr>
		<td><label>CP</label></td>
		<td><input name="cp" type="text" id="cp" size="35"></td>
	</tr>

	<tr>
		<td><label>Direccion</label></td>
		<td><input name="direccion" type="text" id="direccion" size="35"></td>
	</tr>

	<tr>
		<td><label>Lada</label></td>
		<td><input name="lada" type="text" id="lada" size="35"></td>
	</tr>

	<tr>
		<td><label>telefono</label></td>
		<td><input name="num_telefono" type="text" id="num_telefono" size="35"></td>
	</tr>

	<tr>
		<td><label>Extension</label></td>
		<td><input name="ext" type="text" id="ext" size="35"></td>
	</tr>

	<tr>
		<td><label>Fax</label></td>
		<td><input name="fax" type="text" id="fax" size="35"></td>
	</tr>
	<tr>
		<td><label>Correo Electronico</label></td>
		<td><input name="email" type="text" id="email" size="35"></td>
	</tr>

	<tr>
		<td><label>Observaciones</label></td>
		<td><input name="comentario" type="text" id="comentario" size="35"></td>
	</tr>				

</table>
</form> 

