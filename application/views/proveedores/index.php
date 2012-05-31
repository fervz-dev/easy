<?php $this->load->view('hed');?>
<script>

function alta()
{
document.editar_proveedores.reset();
$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 420,
      width: 390,
      modal: true,
      buttons: {
          Aceptar: function() {
          guardar();        
          },
          Cancelar:function()
          {   
        $( "#dialog-procesos" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos" ).dialog( "open" );
}
function edit(id)
{
document.editar_proveedores.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>proveedores/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
                                  dato= data.split('~');
                                  $("#nombre_contacto").val(dato[0]);
                                  $("#nombre_empresa").val(dato[1]);
                                  $("#estado_id_estado").val(dato[2]);
                                  $("#cp").val(dato[3]);
                                  $("#direccion").val(dato[4]);
                                  $("#ciudad").val(dato[5]);
                                  $("#lada").val(dato[6]);
                                  $("#num_telefono").val(dato[7]);
                                  $("#ext").val(dato[8]);
                                  $("#fax").val(dato[9]);
                                  $("#email").val(dato[10]);     
                                  $("#comentario").val(dato[11]);
                                  },
                        error:function(datos){
                        alert("Error al procesar los datos ");
            return false;
                        }//Error
                        });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 490,
      width: 420,
      modal: true,
      buttons: {
          Aceptar: function() {
          editar(id);
          msg('El registro se ha editado correctamente');
            },
          Cancelar:function()
          {
              $( "#dialog-procesos" ).dialog( "close" );
          }
      },
      close: function() {}
    });
        $( "#dialog-procesos" ).dialog( "open" );

}
//Funcion editar empleado

function editar(id)
{
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>proveedores/editar_proveedores/"+id,
                          data:{"nombre_contacto":$("#nombre_contacto").val(),
                                "nombre_empresa":$("#nombre_empresa").val(),
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "ciudad":$("#ciudad").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email").val(),
                                "comentario":$("#comentario").val()},
                    cache: false,
                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                           // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          alert("Error al procesar los datos ");
                      break;
                               case "1": 
                    $( "#dialog-procesos" ).dialog( "close" );
                   // alert('editado');
                 // guardar_paciente(data);
                   reloading();
                  break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                     //alert('Vacante guardada');
                 // reloading();
                   
                   break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error al procesar los datos ");
                             }//Error
                         });//Ajax
           


}



function guardar()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>proveedores/guardar?da="+Math.random()*2312,

                          data:{"nombre_contacto":$("#nombre_contacto").val(),
                                "nombre_empresa":$("#nombre_empresa").val(),
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "cp":$("#cp").val(),
                                "direccion":$("#direccion").val(),
                                "ciudad":$("#ciudad").val(),
                                "lada":$("#lada").val(),
                                "num_telefono":$("#num_telefono").val(),
                                "ext":$("#ext").val(),
                                "fax":$("#fax").val(),
                                "email":$("#email").val(),
                                "comentario":$("#comentario").val(),
                                "peso":$("#peso").val()

                              },

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                            alert("Error al procesar los datos ");
                      break;
                              case "1": 
                           reloading();
                               msg('El registro se ha guardado correctamente');
                         $( "#dialog-procesos" ).dialog( "close" );
                     break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                            alert("Error "+data);
                  break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesperado");
                             }//Error
                         });//Ajax      

}


function delet(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>proveedores/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                           // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          alert("Error al procesar los datos ");
                      break;
                               case "1": 
                    $( "#dialog-procesos" ).dialog( "close" );
                   // alert('editado');
                 // guardar_paciente(data);
                   reloading();
                   msg('Registro eliminado correctamente');
                  break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
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

}


////////////////////////////////////////////////////////////////////////   
    $(document).ready(function(){
	$("#tbl_proveedores").jqGrid({
    url:'<?php echo base_url();?>proveedores/paginacion',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->contacto));
                        colNames:['Acciones',
                                    'CONTACTO',
                                    'NOMBRE',
                                    'ESTADO',
                                    'CP',
                                    'CIUDAD',
                                    'DIRECCION', 
                                    'LADA', 
                                    'TELEFONO', 
                                    'EXT',
                                    'FAX',
                                    'EMAIL',
                                    'COMENTARIO'
                                     ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_contacto', index:'nombre_contacto', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre_empresa', index:'nombre_empresa', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'dsc_estado', index:'dsc_estado', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'cp', index:'cp', width:60,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ciudad', index:'ciudad', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'lada', index:'lada', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'num_telefono', index:'num_telefono', width:120,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ext', index:'ext', width:170,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'fax', index:'fax', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'email', index:'email', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'comentario', index:'comentario', width:90,resizable:false, sortable:true,search:true,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_proveedores',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'proveedores',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
        height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_proveedores").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });
function reloading()
  {
  $("#tbl_proveedores").trigger("reloadGrid")
  }
          			
        </script>
<table align="center"  width="90%">
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_proveedor.png" width="30" height="30"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_proveedores"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="proveedores">
        <?php 
        $this->load->view('proveedores/formulario');?>
        </div>