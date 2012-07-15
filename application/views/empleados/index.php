<?php $this->load->view('hed');?>
<script>

function alta()
{
document.editar_empleado.reset();
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
document.editar_empleado.reset();
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>empleados/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
            //$("#carga_organismos").html(data);data:{"nombre":$("#nombre").val(),"descripcion":$("#descripcion").val(),"direccion":$("#direccion").val(),"colonia":$("#colonia").val(),"poblacion":$("#poblacion").val(),"cp":$("#cp").val(),"telefono":$("#telefono").val(),"fax":$("#fax").val(),"email":$("#email").val(),"web":$("#web").val(),"rfc":$("#rfc").val()},

                        //alert(data);
            dato= data.split('~');
            //alert(cadenaTexto);
            $("#nombre_obrero").val(dato[0]);
            $("#a_paterno").val(dato[1]);
            $("#a_materno").val(dato[2]);
            $("#fecha_nacimiento").val(dato[3]);
            $("#direccion").val(dato[4]);
            $("#celular").val(dato[5]);
            $("#telefono_casa").val(dato[6]);
            $("#puestos_id_tipo_puesto").val(dato[7]);
            $("#oficina_id_oficina").val(dato[8]);
            $("#estado_civil").val(dato[9]); 
            //$("#sexo").val(dato[10]); 
            //alert (dato[10]);
            
            document.getElementById('sexo_'+ dato[10]).setAttribute('checked','checked');     
            $("#estado_id_estado").val(dato[11]);     
            $("#colonia").val(dato[12]);
            $("#ciudad").val(dato[13]);

            },
                        error:function(datos){
                        notify("Error al procesar los datos " ,500,5000,'error');
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
  var sexo =   $("input[name='sexo']:checked").val(); 
//var status_foto  = $(cb.contentDocument).find('#status_foto').val();
//alert($("#status_foto").val());
  $.ajax({
                        async:true,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>empleados/editar_empleado/"+id,
                          data:{"nombre_obrero":$("#nombre_obrero").val(),
                                "a_paterno":$("#a_paterno").val(),
                                "a_materno":$("#a_materno").val(),
                                "fecha_nacimiento":$("#fecha_nacimiento").val(),
                                "direccion":$("#direccion").val(),
                                "celular":$("#celular").val(),
                                "telefono_casa":$("#telefono_casa").val(),
                                "puestos_id_tipo_puesto":$("#puestos_id_tipo_puesto").val(),
                                "oficina_id_oficina":$("#oficina_id_oficina").val(),
                                "estado_civil":$("#estado_civil").val(),
                                "sexo":sexo,
                                "estado_id_estado":$("#estado_id_estado").val(),
                                "colonia":$("#colonia").val(),
                                "ciudad":$("#ciudad").val()},
                    cache: false,
                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                           // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                               case "1": 
                    $( "#dialog-procesos" ).dialog( "close" );
                    notify('El registro se edito correctamente',500,5000,'aviso');
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
                              notify("Error al procesar los datos " ,500,5000,'error');
                             }//Error
                         });//Ajax
           


}



function guardar()
{
  var sexo =   $("input[name='sexo']:checked").val(); 

$.ajax({
          async:true,cache: false,
          beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
           type:"POST",
            url:"<?php echo base_url();?>empleados/guardar?da="+Math.random()*2312,
          data:{"nombre_obrero":$("#nombre_obrero").val(),
                  "a_paterno":$("#a_paterno").val(),
                  "a_materno":$("#a_materno").val(),
                  "fecha_nacimiento":$("#fecha_nacimiento").val(),
                  "direccion":$("#direccion").val(),
                  "celular":$("#celular").val(),
                  "telefono_casa":$("#telefono_casa").val(),
                  "puestos_id_tipo_puesto":$("#puestos_id_tipo_puesto").val(),
                  "oficina_id_oficina":$("#oficina_id_oficina").val(),
                  "estado_civil":$("#estado_civil").val(),
                  "sexo":sexo,
                  "estado_id_estado":$("#estado_id_estado").val(),
                  "colonia":$("#colonia").val(),
                  "ciudad":$("#ciudad").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                            notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                              case "1": 
                           reloading();
                               notify('El registro se guardado correctamente',500,5000,'aviso');
                         $( "#dialog-procesos" ).dialog( "close" );
                     break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                            var error='Error'+data;
                                 notify(error ,500,5000,'error');
                  break; 

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
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
                      url:"<?php echo base_url();?>empleados/eliminar/"+id,
                      datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
                           // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          notify("Error al procesar los datos " ,500,5000,'error');
                      break;
                               case "1": 
                    $( "#dialog-procesos" ).dialog( "close" );
                   // alert('editado');
                 // guardar_paciente(data);
                   reloading();
                   notify('El registro se elimino correctamente',500,5000,'aviso');
                  break;

                                   default:
                                   $( "#dialog-procesos" ).dialog( "close" );
                     //alert('Vacante guardada');
                 // reloading();
                   
                   break; 

                              }//switch
                             },
                        error:function(datos){
                              notify("Error inesperado" ,500,5000,'error');
                             }//Error
                         });//Ajax
}

}


////////////////////////////////////////////////////////////////////////   
    $(document).ready(function(){
	$("#tbl_empleado").jqGrid({
    url:'<?php echo base_url();?>empleados/paginacion',
    datatype: "json",
    mtype: 'POST',
		      //  $data->rows[$i]['cell']=array($acciones,strtoupper($row->nombre),strtoupper($row->descripcion),strtoupper($row->direccion),strtoupper($row->colonia),strtoupper($row->poblacion),strtoupper($row->rfc));
                        colNames:['Acciones',
                                    'NOMBRE',
                                    'APELLIDO PATERNO',
                                    'APELLIDO MATERNO',
                                    'FECHA DE NACIMIENTO',
                                    'ESTADO CIVIL',
                                    'SEXO',
                                    'ESTADO',
                                    'CIUDAD',
                                    'COLONIA',
                                    'DIRECCION', 
                                    'CELULAR', 
                                    'TELEFONO CASA', 
                                    'PUESTO', 
                                    'OFICINA'],
                        colModel:[{name:'acciones', index:'acciones', width:60, resizable:false, align:"center", search:false},
                                  {name:'nombre', index:'nombre', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_paterno', index:'a_paterno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'a_materno', index:'a_materno', width:100,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'fecha_nacimiento', index:'fecha_nacimiento', width:60,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'estado_civil', index:'estado_civil', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'sexo', index:'sexo', width:40,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'dsc_estado', index:'dsc_estado', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'ciudad', index:'ciudad', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'colonia', index:'colonia', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'direccion', index:'direccion', width:90,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'celular', index:'celular', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'telefono_casa', index:'telefono_casa', width:80,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre', index:'nombre', width:120,resizable:false, sortable:true,search:true,editable:true},
                                  {name:'nombre_oficina', index:'nombre_oficina', width:170,resizable:false, sortable:true,search:true,editable:true}
                                  
                                  

                                  
                                ],                             
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id_obrero',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Empleados',
    multiselect: false,
    height:'auto',
    loadtext: 'Cargando',
	width:'100%',
    //searchurl:'<?php echo base_url();?>empresas/buscando',
                height:"auto"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl_empleados").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });
function reloading()
  {
  $("#tbl_empleado").trigger("reloadGrid")
  }
          			
        </script>
<table >
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_empleado.png" width="30" height="30" alta="Agregar Empleado"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        <table id="tbl_empleado"></table>
        <div id="paginacion"> </div>
        <div style="display:none" id="dialog-procesos" title="Empleados">
        <?php 

        $this->load->view('empleados/formulario');?>
        </div>