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
		<td>
			<div onclick="tip('rfc')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
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
		<td><label id="labelRight">Direccion:</label></td>
		<td><input name="direccion" type="text" id="direccion" size="35"></td>
		<td>
			<div onclick="tip('direccion')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
	</tr>

	<tr>
		<td><label id="labelRight">CP:</label></td>
		<td><input name="cp" type="text" id="cp" size="35"></td>
		<td>
			<div onclick="tip('cp')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
	</tr>

	

	<tr>
		<td><label id="labelRight">Lada:</label></td>
		<td><input name="lada" type="text" id="lada" size="35"></td>
		<td>
			<div onclick="tip('lada')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
	</tr>

	<tr>
		<td><label id="labelRight">Telefono:</label></td>
		<td><input name="num_telefono" type="text" id="num_telefono" size="35"></td>
		<td>
			<div onclick="tip('telefono')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
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
		<td><input name="email_" type="text" id="email_" size="35"></td>
		<td>
			<div onclick="tip('email')">
				<ul id="icons" class="ui-widget ui-helper-clearfix">
					<li class="ui-state-default ui-corner-all" title="¿Qué es esto?">
						<span class="ui-icon ui-icon-info"></span>
					</li>
				</ul>
			</div>
		</td>
	</tr>

	<tr>
		<td><label id="labelRight">Observaciones:</label></td>
		<td><input name="comentario" type="text" id="comentario" size="35"></td>
	</tr>				

</table>
</form> 

