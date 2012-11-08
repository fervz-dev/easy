<form name="cat_producto_final" id="cat_producto_final">
<table id="tabla_formulario">
	<tr>
		<td><label id="labelRight">Cliente:</label></td>
		<td><select name="clientesdb"  id="clientesdb">
			<option value="">Seleccione...</option>
			<?php foreach ($clientes as $clt) { ?>
			<option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
			<?php } ?>
		</select>
	</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Nombre del Producto:</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Descripcion:</label>
		</td>
		<td>
			<textarea rows="8" cols="32" name="descripcion" id="descripcion">

			</textarea>

		</td>
	</tr>

</table>
</form>