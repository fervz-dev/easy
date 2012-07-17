<form name="editar_clientes" id="editar_clientes" >
<table>
	
	<tr>
		<td><label id="labelRight">Nombre Empresa:</label></td>
		<td><input name="nombre_empresa" type="text" id="nombre_empresa" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Contacto:</label></td>
		<td><input name="nombre_contacto" type="text" id="nombre_contacto" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Tipo de Persona:</label></td>
		<td><select id="tipo_persona" name="tipo_persona">
				<option value="">Seleccione...</option>
				<option value="MORAL">Moral</option>
				<option value="FISICA">Fisica</option>
			</select>
		</td>
	</tr>

	<tr>
		<td><label id="labelRight">RFC:</label></td>
		<td><input name="rfc" type="text" id="rfc" size="35"></td>
	</tr>
	
	<tr>
		<td><label id="labelRight">Estado:</label></td>
		<td><select  name="estado_id_estado" id="estado_id_estado">
			<option value="0">Seleccione...</option>
			<?php foreach ($estados as $est) { ?>
			<option value="<?php echo $est['id_estado']; ?>"><?php echo $est['dsc_estado'] ?></option>
			<?php } ?>
		</select> 
	</tr>

	<tr>
		<td><label id="labelRight">Ciudad:</label></td>
		<td><input name="ciudad" type="text" id="ciudad" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">CP:</label></td>
		<td><input name="cp" type="text" id="cp" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Direccion:</label></td>
		<td><input name="direccion" type="text" id="direccion" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Lada:</label></td>
		<td><input name="lada" type="text" id="lada" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">telefono:</label></td>
		<td><input name="num_telefono" type="text" id="num_telefono" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Extension:</label></td>
		<td><input name="ext" type="text" id="ext" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Fax:</label></td>
		<td><input name="fax" type="text" id="fax" size="35"></td>
	</tr>
	<tr>
		<td><label id="labelRight">Correo Electronico:</label></td>
		<td><input name="email" type="text" id="email" size="35"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Observaciones:</label></td>
		<td><input name="comentario" type="text" id="comentario" size="35"></td>
	</tr>				

</table>
</form> 

