
<form name="editar_pedido" id="editar_pedido">
<table>
<tr>
	<td>Fecha de Entrega</td>
	<td><input type="text" nombre="fecha_entrega"  id="fecha_entrega"></td>
</tr>

<tr>
	<td><label>Proveedor</label></td>
	<td><select name="proveedor_id_proveedor"  id="proveedor_id_proveedor">
		<option value="">Seleccione...</option>
		<?php foreach ($proveedor as $pvd) { ?>
		<option value="<?php echo $pvd['id_proveedores']; ?>"><?php echo $pvd['nombre_empresa'] ?></option>
		<?php } ?>
	</select>
</tr>

<tr>
	<td><label>Oficina</label></td>
	<td><select name="oficina"  id="oficina">
		<option value="">Seleccione...</option>
		<?php foreach ($oficinas as $ofn) { ?>
		<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
		<?php } ?>
	</select>
</td>
</tr>
</table>
