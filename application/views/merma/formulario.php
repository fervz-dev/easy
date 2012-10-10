<form name="venta_merma" id="venta_merma" >
<table>
	<tr>
		<td><label id="labelRight" id="labelRight">Oficina:</label></td>
		<td><select name="oficina"  id="oficina">
			<option value="">Seleccione...</option>
				<?php foreach ($oficinas as $ofn) { ?>
				<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
				<?php } ?>
			</select>
		</td>
	</tr>

	<tr>
		<td><label id="labelRight" for="">Cantidad:</label></td>
		<td> <input type="text" name="cantidad" id="cantidad"> </td>
	</tr>
	<tr>
		<td><label id="labelRight" id="labelRight">Fecha de Venta:</label></td>
		<td> <input name="fecha_ingreso" type="text" id="fecha_ingreso" size="35"></td>
	</tr>
	<tr>
	<td>
		<label id="labelRight">Cliente:</label>
	</td>
	<td>
		<select name="clientes"  id="clientes">
			<option value="">Seleccione...</option>
			<?php foreach ($clientes as $clt) { ?>
				<option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
			<?php } ?>
		</select>
		</td>
	</tr>
</table>
</form>