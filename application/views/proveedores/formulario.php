<form name="editar_proveedores" id="editar_proveedores" >
<table>
	<tr>
		<td><label>Contacto</label></td>
		<td><input name="nombre_contacto" type="text" id="nombre_contacto" size="35"></td>
	</tr>

	<tr>
		<td><label>Nombre Empresa</label></td>
		<td><input name="nombre_empresa" type="text" id="nombre_empresa" size="35"></td>
	</tr>
	
	<tr>
		<td><label id="labelRight">Estado:</label></td>
		<td><select  name="estado" id="estado" onchange="cargar_datos_municipios(this.value);">
			<option value="">Seleccione...</option>
			<?php foreach ($estados as $est) { ?>
			<option value="<?php echo $est['nombre']; ?>"><?php echo $est['nombre'] ?></option>
			<?php } ?>
		</select> 
	</tr>
	<tr>
		<td><label id="labelRight">Municipio:</label></td>
		<td><select id="municipio" name="municipio" onchange="cargar_datos_localidad(this.value);"></select></td>
			<td id="ajax_municipio"></td>
	</tr>

	<tr>
		<td><label id="labelRight">Localidad:</label></td>
			<td><select id="localidad" name="localidad"></select></td>
			<td id="ajax_localidad"></td>
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
		<!-- <td><textarea name="comentario" id="comentario" cols="32	"></textarea></td> -->
		<td><input name="comentario" type="text" id="comentario" size="35"></td>
	</tr>				

</table>
</form>