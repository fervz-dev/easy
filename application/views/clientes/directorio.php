
<script>
////////////////////////////////  Alta directorio ///////////////////////////////////////////////////

function alta_directorio()
{

/*$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"GET",
          url:"<?php echo base_url();?>clientes/comparar/"+id+"/"+Math.random()*10919939116744,
          datatype:"html",
          success:function(data, textStatus){
                    $("#id_cliente").val(data);
                                },
          error:function(datos){
          notify("Error al procesar los datos " ,500,5000,'error');
          return false;
          }//Error
          });//Ajax*/
$( "#editar_directorio" ).fadeIn();

$("#guardar_edit").fadeIn;
}

///////////////////////////////  Guardar Directorio ////////////////////////////////////////////////

function guardar_nuevo()
{

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
          type:"POST",
          url:"<?php echo base_url();?>clientes/guardar_nuevo?da="+Math.random()*2312,
          data:{"clientes_id_clientes":$("#id_cliente").val(),
                "estado_id_estado_d":$("#estado_id_estado_d").val(),
                "direccion_d":$("#direccion_d").val(),    
                "colonia_d":$("#colonia_d").val(),
                "ciudad_d":$("#ciudad_d").val()},

          cache: false,
          datatype:"html",
          
          success:function(data, textStatus){
          
          switch(data){
          case "0": 
                  notify("Error al procesar los datos " ,500,5000,'error');
          break;
          
          case "1": 
                  $( "#tbl_directorio" ).trigger("reloadGrid");
                  $( "#editar_directorio" ).fadeOut();
          break;
          
          }//switch
          },
          error:function(datos)
                {
                  notify("Error al procesar los datos " ,500,5000,'error');
                }//Error
          });//Ajax
           


}
///////////////////////////////////////////////////////////////////////////////////////
function edit_dir(id)
{

document.directorio.reset();


$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>clientes/get_directorio/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){

            dato= data.split('~');
                                  $("#id_direcciones").val(dato[0]);
                                  $("#estado_id_estado_d").val(dato[1]);
                                  $("#direccion_d").val(dato[2]);
                                  $("#colonia_d").val(dato[3]);
                                  $("#ciudad_d").val(dato[4]);
                                  $("#observaciones_d").val(dato[5]);
                                              },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
            return false;
                        }//Error
                        });//Ajax
$( "#editar_directorio" ).fadeIn();

}
//Funcion editar empleado

//////////////////////////////////////////////////////////////////////////////////////


////////////////////////////////// Editar ///////////////////////////////////////////

function editar_directorio_all()
{
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>clientes/editar_directorio_all/",
                          data:{"estado_id_estado_d":$("#estado_id_estado_d").val(),
                                "direccion_d":$("#direccion_d").val(),    
                                "colonia_d":$("#colonia_d").val(),
                                "ciudad_d":$("#ciudad_d").val(),
                                "observaciones_d":$("#observaciones_d").val(),
                                "id_direcciones":$("#id_direcciones").val(),
                              },
                    cache: false,
                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                                  notify("Error al procesar los datos " ,500,5000,'error');
                               break;
                               case "1": 
                            $( "#tbl_directorio" ).trigger("reloadGrid");
                             $( "#editar_directorio" ).fadeOut();


                            break;
                              }//switch
                             },
                        error:function(datos){
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
           


}

////////////////////////////////////////////////////////////////////////////////////
function directorio (id) {
  $("#tbl_directorio").jqGrid('GridUnload');


  
	$("#tbl_directorio").jqGrid({
    url:'<?php echo base_url();?>clientes/paginacion_directorio/',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->contacto));
                        colNames:['Acciones',
                                    'ESTADO',
                                    'DIRECCION',
                                    'COLONIA',
                                    'CIUDAD',
                                    'OBSERVACIONES'
                                     ],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'dsc_estado', index:'dsc_estado', width:100,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'direccion', index:'direccion', width:80,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'colonia', index:'colonia', width:100,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'ciudad', index:'ciudad', width:100,resizable:false, sortable:true,search:false,editable:true},
                                  {name:'observaciones', index:'observaciones', width:100,resizable:false, sortable:true,search:false,editable:true}
                                ],                             
    pager: jQuery('#paginacion_directorio'),
    postData: {id: id},  
    rownumbers:true,
	  rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_direcciones',
    viewrecords: true,
    sortorder: "asc",
	  editable: true,
    caption: 'directorio',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion_directorio", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_directorio").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ;
   //});
//$("#tbl_directorio").jqGrid('setGridParam', {id: id}).trigger("reloadGrid");
    // console.log( typeof($('#tb1_directorio')));
    
}

   </script>
   <table id="tbl_directorio"></table>
        <div id="paginacion_directorio">
        </div>

<div id="editar_directorio" style="display:none">

        <?php 
        $this->load->view('clientes/editar_directorio');?>

</div>