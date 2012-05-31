<form name="editar_empleado" id="editar_empleado" >
<table>

<tr>
	<td><label>Nombre</label></td>
	<td> <input name="nombre_obrero" type="text" id="nombre_obrero" size="35"> </td>
</tr>	

<tr>
	<td><label>Apellido Paterno</label></td>
	<td> <input name="a_paterno" type="text" id="a_paterno" size="35"></td>
</tr>

<tr>
	<td><label>Apellido Materno</label></td>
	<td> <input name="a_materno" type="text" id="a_materno" size="35"></td>
</tr>

<tr>
	<td><label>Fecha de Nacimiento</label></td>
	<td> <input name="fecha_nacimiento" type="text" id="fecha_nacimiento" size="35"></td>
</tr>

<tr>
	<td><label>Estado Civil</label></td>
	<td> <input name="estado_civil" type="text" id="estado_civil" size="35"></td>
</tr>

<tr>
	<td><strong>Sexo</strong>:</td>
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
	<td> <input name="ciudad" type="text" id="ciudad" size="35"></td>
</tr>

<tr>
	<td><label>Colonia</label></td>
	<td> <input name="colonia" type="text" id="colonia" size="35"></td>
</tr>



<tr>
	<td><label>Direccion</label></td>
	<td> <input name="direccion" type="text" id="direccion" size="35"></td>
</tr>

<tr>
	<td><label>Tel movil</label></td>
	<td> <input name="celular" type="text" id="celular" size="35"></td>
</tr>

<tr>
	<td><label>Tel Casa</label></td>
	<td> <input name="telefono_casa" type="text" id="telefono_casa" size="35"></td>
</tr>

<tr>
	<td><label>Puesto</label></td>
	<td><select id="puestos_id_tipo_puesto" name="puestos_id_tipo_puesto">
			<option value="0">Seleccione...</option>
			<?php foreach ($puestos as $puesto) { ?>
			<option value="<?php echo $puesto['id_tipo_puesto']; ?>"><?php echo $puesto['nombre'] ?></option>
			<?php } ?>
		</select> 
</tr>

<tr>
	<td><label>Oficina</label></td>
	<td><select name="oficina_id_oficina"  id="oficina_id_oficina">
		<option value="0">Seleccione...</option>
		<?php foreach ($oficinas as $ofn) { ?>
		<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
		<?php } ?>
	</select> 
	</tr>
</tr>

</table>
</form>