<form name="editar_empleado" id="editar_empleado" >
<table>

<tr>
	<td><label id="labelRight">Nombre:</label></td>
	<td> <input name="nombre_obrero" type="text" id="nombre_obrero" size="35"> </td>
</tr>

<tr>
	<td><label id="labelRight">Apellido Paterno:</label></td>
	<td> <input name="a_paterno" type="text" id="a_paterno" size="35"></td>
</tr>

<tr>
	<td><label id="labelRight">Apellido Materno:</label></td>
	<td> <input name="a_materno" type="text" id="a_materno" size="35"></td>
</tr>

<tr>
	<td><label id="labelRight">Fecha de Nacimiento:</label></td>
	<td> <input name="fecha_nacimiento" type="text" id="fecha_nacimiento" size="35"></td>
</tr>

<tr>
	<td><label id="labelRight">Estado Civil:</label></td>
	<td> <input name="estado_civil" type="text" id="estado_civil" size="35"></td>
</tr>

<tr>
	<td><strong id="labelRight">Sexo</strong></td>
  	<td>
    <label>
      <input type="radio" name="sexo" value="M" id="sexo_M">
      Masculino
  	</label>

    <label>

      <input type="radio" name="sexo" value="F" id="sexo_F">
      Femenino</label>
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
	<td><label id="labelRight">Celular:</label></td>
	<td> <input name="celular" type="text" id="celular" size="35"></td>
</tr>

<tr>
		<td><label id="labelRight">Correo Electronico::</label></td>
		<td><input name="email" type="text" id="email" size="35"></td>
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
	<td><label id="labelRight">Puesto:</label></td>
	<td><select id="puestos_id_tipo_puesto" name="puestos_id_tipo_puesto">
			<option value="">Seleccione...</option>
			<?php foreach ($puestos as $puesto) { ?>
			<option value="<?php echo $puesto['id_tipo_puesto']; ?>"><?php echo $puesto['nombre'] ?></option>
			<?php } ?>
		</select>
</tr>

<tr>
	<td><label id="labelRight">Oficina:</label></td>
	<td><select name="oficina_id_oficina"  id="oficina_id_oficina">
		<option value="">Seleccione...</option>
		<?php foreach ($oficinas as $ofn) { ?>
		<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
<tr>
		<td><label id="labelRight">Observaciones:</label></td>
		<td><input name="comentario" type="text" id="comentario" size="35"></td>
	</tr>

</table>
</form>