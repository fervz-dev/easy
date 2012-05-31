<script type="text/javascript">   

function alta()
{
document.editar_oficina.reset();
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

function editar(id)
{

//var status_foto  = $(cb.contentDocument).find('#status_foto').val();
//alert($("#status_foto").val());
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>oficina/editar_oficina/"+id,
                          data:{"nombre_oficina":$("#nombre_oficina").val(),
                                "tipo_oficina_id_tipo_oficina":$("#tipo_oficina_id_tipo_oficina").val(),
                                "direccion":$("#direccion").val(),
                                "colonia":$("#colonia").val(),
                                "telefono":$("#telefono").val(),
                                "rfc":$("#rfc").val(),
                                "ciudad":$("#ciudad").val(),
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "cp":$("#cp").val(),
                                "logo":$("#logo").val(),
                                "observaciones":$("#observaciones").val(),
                                "coordx":$("#coordx").val(),
                                "coordy":$("#coordy").val()},
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

  
function edit(id)
{
document.editar_oficina.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>oficina/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
            //$("#carga_organismos").html(data);data:{"nombre":$("#nombre").val(),"descripcion":$("#descripcion").val(),"direccion":$("#direccion").val(),"colonia":$("#colonia").val(),"poblacion":$("#poblacion").val(),"cp":$("#cp").val(),"telefono":$("#telefono").val(),"fax":$("#fax").val(),"email":$("#email").val(),"web":$("#web").val(),"rfc":$("#rfc").val()},

                        //alert(data);
            dato= data.split('~');
            //alert(cadenaTexto);
            $("#nombre_oficina").val(dato[0]);
            $("#tipo_oficina_id_tipo_oficina").val(dato[1]);
            $("#direccion").val(dato[2]);
            $("#colonia").val(dato[3]);
            $("#telefono").val(dato[4]);
            $("#rfc").val(dato[5]);
            $("#ciudad").val(dato[6]);
            $("#estado_id_estado").val(dato[7]);
            $("#cp").val(dato[8]);
            $("#logo").val(dato[9]); 
            $("#observaciones").val(dato[10]);     
            $("#coordx").val(dato[11]);
            $("#coordy").val(dato[12]);

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




  $(document).ready(function(){
	$("#tbl_oficina").jqGrid({
    url:'<?php echo base_url();?>oficina/paginacion',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->rfc));

                        colNames:['Acciones',
                                  'OFICINA',
                                  'TIPO',
                                  'DIRECCION',
                                  'COLONIA',
                                  'TELEFONO',
                                  'RFC',
                                  'OBSERVACIONES',
                                  'CIUDAD',
                                  'ESTADO',
                                  'CP'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:170,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre', index:'nombre', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'direccion', index:'direccion', width:200,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'colonia', index:'colonia', width:150,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'telefono', index:'telefono', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'rfc', index:'rfc', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'observaciones', index:'observaciones', width:200,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ciudad', index:'ciudad', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'dsc_estado', index:'dsc_estado', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'cp', index:'cp', width:50,resizable:false, sortable:true,search:true,editable:true}
                                  
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_oficina',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Oficina',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_oficina").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });   
function reloading()
  {
  $("#tbl_oficina").trigger("reloadGrid")
  }

  function guardar()
{
$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>oficina/guardar?da="+Math.random()*2312,
          data:{
            "nombre_oficina":$("#nombre_oficina").val(),
            "tipo_oficina_id_tipo_oficina":$("#tipo_oficina_id_tipo_oficina").val(),
            "direccion":$("#direccion").val(),
            "colonia":$("#colonia").val(),
            "telefono":$("#telefono").val(),
            "rfc":$("#rfc").val(),
            "ciudad":$("#ciudad").val(),
            "estado_id_estado":$("#estado_id_estado").val(),
            "cp":$("#cp").val(),
            "logo":$("#logo").val(), 
            "observaciones":$("#observaciones").val(),
            "coordx":$("#coordx").val(),
            "coordy":$("#coordy").val()
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
                      url:"<?php echo base_url();?>oficina/eliminar/"+id,
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


          			
        </script>
<table align="center"  width="90%">
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_oficina.png" width="30" height="30"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_oficina"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Empleados">
        <?php 

        $this->load->view('oficina/formulario');?>
        </div>