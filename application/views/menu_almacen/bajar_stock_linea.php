<?php $this->load->view('hed');?>
<script type="text/javascript">
/////////////////////////////////////////////// crear codigo de pedido a provedores /////////////////////////////////////////////////////////////////////

function nuevo_code (id) {
	 $.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>almacen_linea/nuevo_code/"+id,
          datatype:"html",
          success:function(data, textStatus){
                                            
                                            switch(data){
                                                          case "0": 
                                                                  $("#ErrorDatos").fadeIn();
                                                                  $("#ErrorDatos").html("Error al procesar los datos.");
                                                                  //alert("Error al procesar los datos ");
                                                          break;
                                             
                                                          case "1": 
                                                          
                                                                  $( "#dialogo" ).dialog( "close" );
                                                                  // alert('editado');
                                                                  // guardar_paciente(data);
                                                                  $("#tbl_p_prove").trigger("reloadGrid"); 
                                                                  msg('Pedido cerrado satisfacotiramente');
                                                          break;
                                                 
                                                          default:
                                                                  $( "#dialogo").dialog( "close" );
                                                                  //alert('Vacante guardada');
                                                                  // reloading();
                                                          break; 
                                            
                                                        }//switch
                                            },
          error:function(datos){
                                alert("Error inesparado");
                             }//Error
          });//Ajax
	
}


/////////////////////////////////////////////// inicia la paginacion y subpaginacion ////////////////////////////////////////////////////////////////////
	$(document).ready(function(){
		$("#tabs").tabs();
		$("#tbl_linea").jqGrid({
			url:'<?php echo base_url();?>almacen_linea/paginacion',
			 datatype: "json",
    mtype: 'POST',
		      
                        colNames:['Acciones',
                                    'ID PEDIDO',
                                    'FECHA DE PEDIDO',
                                    'FECHA DE ENTREGA',
                                    'PROVEEDOR',
                                    'LUGAR DE ENVIO'
                                    ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:true, align:"center", search:false},
                                  {name:'id_pedido', index:'id_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_pedido', index:'fecha_pedido', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'fecha_entrega', index:'fecha_entrega', width:30,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:true, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:90,resizable:true, sortable:true,search:true,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_pedido',
    viewrecords: true,
    sortorder: "asc",
  editable: true,
    caption: 'Pedido de linea',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
  width:'950',
  subGrid: true, 
    // searchurl:'<?php echo base_url();?>empresas/buscando',
    height:"auto",
   subGridRowExpanded: function(subgrid_id, row_id) {
   var subgrid_table_id, pager_id; subgrid_table_id = subgrid_id+"_t"; pager_id = "p_"+subgrid_table_id;
   
   $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' alt='subtabla' class='scroll'></table><div id='"+pager_id+"' class='scroll'></div>"); 
   
   $("#"+subgrid_table_id).jqGrid({ 
   //url:"subgrid.php?q=2&id="+row_id, 
   url:"<?php echo base_url();?>almacen_linea/subpaginacion/"+row_id,
   datatype: "json",
   mtype: 'POST',
   colNames: ['ACCI&Oacute;N', 'No', 'NOMBRE','ANCHO','LARGO','CANTIDAD'],    
   colModel: [
             {name:"acciones",index:"acciones",width:56,align:"center"},
             {name:"No",index:"No",width:56,align:"center"},
             {name:"nombre",index:"nombre",search: false,align:"center"},
             {name:"ancho",index:"ancho",align:"left",search: false},
             {name:"largo",index:"largo",align:"left",search: false},
             {name:"cantidad",index:"cantidad",align:"left",search: false}
              ],
   rows:10, 
   rowNum:10,
   rowList:[10,15],
   pager: pager_id,
   sortname: 'id_cantidad_pedido',
   height:'auto',
   sortorder: "asc" }); 
   
   $("#"+subgrid_table_id).jqGrid('navGrid',"#"+pager_id,{edit:false,add:false,del:false,search:false}) }
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_linea").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
      $("#tbl_linea").jqGrid('navGrid','#paginacion',{add:false,edit:false,del:false,search:false});


	});


</script>
<div class="demo">
<div id="tabs">
	<ul>
		<li><a href="#linea" onclick="paginacion_linea">Linea</a></li>
		<li><a href="#reutilizable">Reutilizable</a></li>
		<li><a href="#productos_terminados">Productos terminados</a></li>
	</ul>
	<div id="linea">
    <table>
            <tr>
              <td>
                <button onclick="javascrip:stock();" title="Bajar pedido de linea">
                  <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Proveedor</p></div></div>  
                </button>
              </td>
              <td>
                <button onclick="javascrip:stock();" title="Bajar pedido de linea">
                  <div style="width:120px; height:30px;"><img src="img/bajar_stock.png" width="30" height="30" style="float:left;"><div style="float:left;"><p style="font-size:12px; color:#108de2; margin-top: 10px; margin-bottom: 0px;">&nbsp &nbsp Nave</p></div></div>  
                </button>
              </td>
            </tr>
          </table>
		<table id="tbl_linea"></table>
        <div id="paginacion"> </div>    
        <div style="display:none" id="dialog-procesos" title="Pedidos">


        <?php 
        $this->load->view('pedidos_proveedores/formulario');?>
        </div>
	</div>
	<div id="reutilizable">
		
	</div>
	<div id="productos_terminados">
	</div>
</div>

</div>