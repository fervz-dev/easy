<style type="text/css">

table {border-spacing: 0; } /* IMPORTANT, I REMOVED border-collapse: collapse; FROM THIS LINE IN ORDER TO MAKE THE OUTER BORDER RADIUS WORK */

/*------------------------------------------------------------------ */


.tablePC a:link {
  color: #000;
  font-weight: bold;
  text-decoration:none;
}
.tablePC a:visited {
  color: #000;
  font-weight:bold;
  text-decoration:none;
}
.tablePC a:active,
.tablePC a:hover {
  color: #000;
  text-decoration:underline;
}


/*
Table Style - This is what you want
------------------------------------------------------------------ */
.tablePC table a:link {
  color: #000000;
  font-weight: bold;
  text-decoration:none;
}
.tablePC table a:visited {
  color: #000;
  font-weight:bold;
  text-decoration:none;
}
.tablePC table a:active,
.tablePC table a:hover {
  color: #bd5a35;
  text-decoration:underline;
}
.tablePC table {
  font-family:Arial, Helvetica, sans-serif;
  color:#000;
  font-size:12px;
  text-shadow: 1px 1px 0px #fff;
  background:#eaebec;
  margin:20px;
  border:#ccc 1px solid;

  -moz-border-radius:3px;
  -webkit-border-radius:3px;
  border-radius:3px;

  -moz-box-shadow: 0 1px 2px #d1d1d1;
  -webkit-box-shadow: 0 1px 2px #d1d1d1;
  box-shadow: 0 1px 2px #d1d1d1;
}
.tablePC table th {
  padding:5px 6px 5px 6px;
  border-top:1px solid #fafafa;
  border-bottom:1px solid #e0e0e0;

  background: #03478E;
  background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
  background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}

.tablePC table th:first-child{
  text-align: left;
  padding-left:20px;


}

.tablePC input {
  width: 50px;
  height:20px;

}
.tablePC table tr:first-child th:first-child{
  -moz-border-radius-topleft:3px;
  -webkit-border-top-left-radius:3px;
  border-top-left-radius:3px;
      padding:7px 9px 6px 6px;
}
.tablePC table tr:first-child th:last-child{
  -moz-border-radius-topright:3px;
  -webkit-border-top-right-radius:3px;
  border-top-right-radius:3px;
        padding:7px 9px 6px 6px;
}
.tablePC table tr{
  text-align: center;
  padding-left:20px;
}
.tablePC table tr td:first-child{
  text-align: left;
  padding-left:20px;
  border-left: 0;
}
.tablePC table tr td {
  padding:10px;
  border-top: 1px solid #ffffff;
  border-bottom:1px solid #e0e0e0;
  border-left: 1px solid #e0e0e0;

  background: #fafafa;
  background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
  background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
.tablePC table tr.even td{
  background: #f6f6f6;
  background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
  background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
.tablePC table tr:last-child td{
  border-bottom:0;
}
.tablePC table tr:last-child td:first-child{
  -moz-border-radius-bottomleft:3px;
  -webkit-border-bottom-left-radius:3px;
  border-bottom-left-radius:3px;
}
.tablePC table tr:last-child td:last-child{
  -moz-border-radius-bottomright:3px;
  -webkit-border-bottom-right-radius:3px;
  border-bottom-right-radius:3px;
}
.tablePC table tr:hover td{
  background: #f2f2f2;
  background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
  background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);
}

</style>
<form name="editar_pedido" id="editar_pedido">
<table>
  <tr>
  <td><label>Cliente</label></td>
  <td><select name="clientes"  id="clientes" onchange='cargarProductos(this.value)'>
    <option value="">Seleccione...</option>
    <?php foreach ($clientes as $clt) { ?>
    <option value="<?php echo $clt['id_clientes']; ?>"><?php echo $clt['nombre_empresa'] ?></option>
    <?php } ?>
  </select>
</td>
</tr>
<!-- cargar productos por cliente -->
<tr id="hideProductos">
  <td><label id="textProductos">Produtos del cliente:</label></td>
  <td><select  name="productos"  id="productos" onchange="cargarComponentes(this.value)">

  </select>
</td>
<td id="ajax_productos"></td>
</tr>
<!-- end -->

<tr>
  <td colspan="2">
    <div id="ajaxCompponentesProducto" class="tablePC" style="margin-left: 100px;">

</div>
<div id="ajaxCompponentesProducto_load"></div>
  </td>
</tr>
<tr>
	<td>Fecha de Entrega:</td>
	<td><input type="text" nombre="fecha_entrega"  id="fecha_entrega"></td>
</tr>
<tr>
	<td><label>Nave:</label></td>
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
function cargarProductosEditar (clientesdb,producto) {
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
                        $("#productos").val(producto);
                        // cargarComponentes(producto);

                }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientes").focus();
    }
  }

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
     clientesdb=$('#clientes').val();
  	if (clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>producto_final/componentesProducto/"+idProducto+"/"+clientesdb,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajaxCompponentesProducto_load").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){

                            $("#ajaxCompponentesProducto").html(html);
                            $("#ajaxCompponentesProducto_load").html("");
                    }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientes").focus();
  }
}
  function cargarComponentesEditar (idPedido) {
     clientesdb=$('#clientes').val();
    if (clientesdb!='') {
      $.ajax({
                    url:"<?php echo base_url();?>pedidos_bodega_prod_term/editarProductoComponentes/"+idPedido,
                    type:"POST",
                    beforeSend: function(){
                       $("#ajaxCompponentesProducto_load").html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');
                    },
                    success: function(html){

                            $("#ajaxCompponentesProducto").html(html);
                            $("#ajaxCompponentesProducto_load").html("");
                    }
    });
    }else if(tipoIngreso==1 && clientesdb==''){
       notify('* Debes de seleccionar un cliente!!!',500,5000,'error');
              $("#clientes").focus();
  }
}
</script>