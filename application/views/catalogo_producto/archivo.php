

<form action="<?php echo base_url();?>catalogo_producto/do_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data" name="archivo" id="archivo">
<table>
<tr>
	<td><label id="labelRight">Nombre de la imagen:</label></td>
	<td><input type="text" id="nombre_archivo" name="nombre_archivo"></td>
</tr>

<tr>
	<td><label id="labelRight">Descripcion de la imagen:</label></td>
	<td><input type="text" id="descripcion_archivo" name="descripcion_archivo"></td>

</tr>
<tr>
	<input name="id_cat" type="hidden" id="id_cat" size="35">
	<td><label id="labelRight">Agregar...</label></td>
	<td><input type="file" name="userfile"   id="userfile" size="20" /></td>
	<td><label for="">*Solo archivos con extensión (*.jpg)</label></td>
</tr>
<!-- <input  type="submit" value="enviar"> -->
</form>
</table>
