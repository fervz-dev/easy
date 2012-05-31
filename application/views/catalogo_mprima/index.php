<script type="text/javascript">   
  $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>catalogo_mprima/paginacion',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->rfc));

                        colNames:['Acciones','NOMBRE','CARACTERISTICA','TIPO','GROSOR','ANCHO','LARGO','RESISTENCIA'],
                        colModel:[{name:'id_cat_mprima', index:'id_cat_mprima', width:170,resizable:false, sortable:true,search:false,editable:false},
                                  {name:'nombre', index:'nombre', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'caracteristica', index:'caracteristica', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo', index:'tipo', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'tipo_m', index:'tipo_m', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ancho', index:'ancho', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'largo', index:'largo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'resistencia', index:'resistencia', width:80,resizable:false, sortable:true,search:true,editable:true}
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_cat_mprima',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Catalogo de Materia Prima',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });

function edit(id)
{
document.cat_mprima.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>catalogo_mprima/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
            //$("#carga_organismos").html(data);data:{"nombre":$("#nombre").val(),"descripcion":$("#descripcion").val(),"direccion":$("#direccion").val(),"colonia":$("#colonia").val(),"poblacion":$("#poblacion").val(),"cp":$("#cp").val(),"telefono":$("#telefono").val(),"fax":$("#fax").val(),"email":$("#email").val(),"web":$("#web").val(),"rfc":$("#rfc").val()},

                        //alert(data);
            dato= data.split('~');
            //alert(cadenaTexto);
            $("#nombre").val(dato[0]);
            $("#caracteristica").val(dato[1]);
            $("#tipo").val(dato[2]);
            $("#tipo_m").val(dato[3]);
            $("#ancho").val(dato[4]);
            $("#largo").val(dato[5]);
            $("#resistencia_mprima_id_resistencia_mprima").val(dato[5]);
            },
                        error:function(datos){
                        alert("Error al procesar los datos ");
            return false;
                        }//Error
                        });//Ajax


$( "#dialog-procesos" ).dialog({
      autoOpen: false,
      height: 250,
      width: 380,
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

function reloading()
{
  $("#tbl").trigger("reloadGrid")
}

function editar(id)
{
//var status_foto  = $(cb.contentDocument).find('#status_foto').val();
//alert($("#status_foto").val());
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>catalogo_mprima/editar_mprima/"+id,
                          data:{"nombre":$("#nombre").val(),
                                "caracteristica":$("#caracteristica").val(),
                                "tipo":$("#tipo").val(),
                                "tipo_m":$("#tipo_m").val(),
                                "ancho":$("#ancho").val(),
                                "largo":$("#largo").val(),
                                "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val()               
                              },
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

function delet(id)
{
r=confirm('Esta seguro de eliminar el registro?');
if(r==true)
{
  $.ajax({
                      async:true,cache: false,
                      beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                      type:"POST",
                      url:"<?php echo base_url();?>catalogo_mprima/eliminar/"+id,
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

function guardar()
{
  var sexo =   $("input[name='sexo']:checked").val(); 

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>catalogo_mprima/guardar?da="+Math.random()*2312,
            data:{"nombre":$("#nombre").val(),
                  "caracteristica":$("#caracteristica").val(),
                  "tipo":$("#tipo").val(),
                  "tipo_m":$("#tipo_m").val(),
                  "ancho":$("#ancho").val(),
                  "largo":$("#largo").val(),
                  "resistencia_mprima_id_resistencia_mprima":$("#resistencia_mprima_id_resistencia_mprima").val()               
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

function alta()
{
document.cat_mprima.reset();
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


</script>
<table align="center"  width="90%">
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/nuevo.ico"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Catalogo">
        <?php 

        $this->load->view('catalogo_mprima/formulario');?>
