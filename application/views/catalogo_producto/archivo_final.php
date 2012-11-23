

<form action="<?php echo base_url();?>catalogo_producto/do_uploadProductoFinal" method="post" accept-charset="utf-8" enctype="multipart/form-data" name="archivoCatalogoFinal" id="archivocatalogoFinal">
<table>
<tr>
	<td><label id="labelRight">Nombre de la imagen:</label></td>
	<td><input type="text" id="nombre_archivoCatalogoFinal" name="nombre_archivoCatalogoFinal"></td>
</tr>

<tr>
	<td><label id="labelRight">Descripcion de la imagen:</label></td>
	<td><input type="text" id="descripcion_archivoCatalogoFinal" name="descripcion_archivoCatalogoFinal"></td>

</tr>
<tr>
	<input name="id_catCatalogoFinal" type="hidden" id="id_catCatalogoFinal" size="35">
	<td><label id="labelRight">Agregar...</label></td>
	<td><input type="file" name="userfileCatalogoFinal"   id="userfileCatalogoFinal" size="20" /></td>
	<td><label for="">*Solo archivos con extensión (*.jpg)</label></td>
</tr>
<!-- <input  type="submit" value="enviar"> -->
</form>
</table>
