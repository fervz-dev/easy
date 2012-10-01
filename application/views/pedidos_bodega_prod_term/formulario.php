
<form name="editar_pedido" id="editar_pedido">
<table>
<tr>
	<td>Fecha de Entrega</td>
	<td><input type="text" nombre="fecha_entrega"  id="fecha_entrega"></td>
</tr>

<tr>
	<td><label>Cliente</label></td>
	<td><select name="clientes"  id="clientes">
		<option value="">Seleccione...</option>
		<?php foreach ($clientes as $clt) { ?>
		<option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
		<?php } ?>
	</select>
</td>
</tr>

<tr>
	<td><label>Bodega (Origen de Pedido)</label></td>
	<td><select name="oficina_pedido"  id="oficina_pedido">
		<option value="">Seleccione...</option>
		<?php foreach ($oficinas as $ofn) { ?>
		<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
		<?php } ?>
	</select>
</td>
</tr>

<!-- <tr>
	<td><label>Bodega (Destino Pedido)</label></td>
	<td><select name="oficina"  id="oficina">
		<option value="">Seleccione...</option>
		<?php foreach ($oficinas as $ofn) { ?>
		<option value="<?php echo $ofn['id_oficina']; ?>"><?php echo $ofn['nombre_oficina'] ?></option>
		<?php } ?>
	</select>
</td>
</tr> -->
</table>
