
<form name="editar_pedido" id="editar_pedido">
<table>
<tr>
	<td>Fecha de Entrega</td>
	<td><input type="text" nombre="fecha_entrega"  id="fecha_entrega"></td>
</tr>

<tr>
	<td><label>Cliente</label></td>
	<td><select name="clientes"  id="clientes" onchange="cargarProductos(this.value);">
		<option value="">Seleccione...</option>
		<?php foreach ($clientes as $clt) { ?>
		<option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
		<?php } ?>
	</select>
</td>
</tr>
<!-- cargar productos por cliente -->
</tr>
<tr id="hideProductos">
	<td><label id="textProductos">Produtos del cliente:</label></td>
	<td><select name="productos"  id="productos" onchange="cargarComponentes(this.value)">

	</select>
</td>
<td id="ajax_productos"></td>
</tr>
<!-- end -->
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
</form>
<script type="text/javascript">
function cargarProductos (clientesdb) {
    // clientesdb=$('#clientes').val();
    if (clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>producto_final/productosCliente/"+clientesdb,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_productos").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#productos").html(html);
                            $("#ajax_productos").html("");
                    }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientes").focus();
    }

  }
  function cargarComponentes (idProducto) {
  	if (clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>producto_final/productosCliente/"+clientesdb,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajax_componentes").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){
                            $("#componentes").html(html);
                            $("#ajax_productos").html("");
                    }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientes").focus();
  }
</script>