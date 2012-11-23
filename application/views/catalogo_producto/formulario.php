<style type="text/css">
	#box{ border-style:solid;
border-color:red; height:10px;}
</style>
<form name="cat_producto" id="cat_producto">
<table id="tabla_formulario">

<!-- 	<tr>
		<td><label for="">Forma de Ingreso:</label></td>
		<td>
			<table  id="box">
			<tr>
				<td  ><input type="radio" id="tipoProducto" name="tipoProducto" value="1">Producto</td>
				<td ><input type="radio" id="tipoProducto" name="tipoProducto" value="2">Componente</td>
			</tr>
			</table>
		</td>
	</tr> -->

<tr >

	<td><label>Tipo de ingreso:</label></td>
	<td><select name="tipoIngreso"  id="tipoIngreso">
		<option value="">Seleccione...</option>
		<option value="1">Componente</option>
		<option value="2">Producto</option>

	</select>
</td>
</tr>


<tr >

	<td><label>Cliente:</label></td>
	<td><select name="clientesdb"  id="clientesdb"  onchange="cargarProductos();">
		<option value="">Seleccione...</option>
		<?php foreach ($clientes as $clt) { ?>
		<option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
		<?php } ?>
	</select>
</td>
</tr>
<tr>
	<td><label>Produtos del cliente:</label></td>
	<td><select name="productosBD"  id="productosBD" >

	</select>
</td>
<td id="ajax_productos"></td>
</tr>

	<tr>
		<td>
			<label id="labelRight">Nombre:</label>
		</td>
		<td>
			<input name="nombre" type="text" id="nombre" size="35">
		</td>
	</tr>
	<tr>
		<td>
			<label id="labelRight">Largo:</label>
		</td>
		<td>
			<input name="largo" type="text" id="largo" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Ancho:</label>
		</td>
		<td>
			<input name="ancho" type="text" id="ancho" size="35">
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Altura:</label>
		</td>
		<td>
			<input name="alto" type="text" id="alto" size="35">
		</td>
	</tr>
<tr>
	<td><label id="labelRight">Resitencia:</label></td>
	<td><select id="resistencia_mprima_id_resistencia_mprima" name="resistencia_mprima_id_resistencia_mprima">
			<option value="">Seleccione...</option>
			<?php foreach ($resistencia as $rst) { ?>
			<option value="<?php echo $rst['id_resistencia_mprima']; ?>"><?php echo $rst['resistencia'] ?></option>
			<?php } ?>
		</select>
	</td>
	</tr>
	<tr>
		<td><label id="labelRight">Corrugado:</label></td>
		<td><select id="corrugado" name="corrugado">
				<option value="">Seleccione...</option>
				<option value="SENCILLO">SENCILLO</option>
				<option value="DOBLE">DOBLE</option>

			</select>
		</td>
	</tr>

	<tr>
		<td>
			<label id="labelRight">Score:</label>
		</td>
		<td>
			<input name="score" type="text" id="score" size="35">
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