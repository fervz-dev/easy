<?php $this->load->view('hed');?>
<script>
function edit(id)
{
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                        type:"GET",
                        url:"<?php echo base_url();?>usuarios/get/"+id+"/"+Math.random()*10919939116744,
                        datatype:"html",
                        success:function(data, textStatus){
						//$("#carga_organismos").html(data);
                        //alert(data);
						dato= data.split('~');
						//alert(cadenaTexto);
						$("#oficina").val(dato[0]);
						$("#rol").val(dato[2]);
						$("#nombre_completo").val(dato[4]);
						$("#usuario").val(dato[1]);
						$("#email").val(dato[3]);
												
						},
                        error:function(datos){
                        alert("Error al procesar los datos ");
						return false;
                        }//Error
                        });//Ajax
$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 320,
			width: 550,
			modal: true,
			buttons: {
					Aceptar: function() {
					editar(id);
					msg('El registro se ha editado correctamente');
				    },
					Cancelar:function()
					{
        			$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});
				$( "#dialog-alta" ).dialog( "open" );

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
                          url:"<?php echo base_url();?>usuarios/borrar/"+id,
                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
							             // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          alert("Error al procesar los datos ");
										  break;
                               case "1": 
							      $( "#dialog-alta" ).dialog( "close" );
  								 // alert('editado');
								 // guardar_paciente(data);
								   reloading();
								   msg('Registro eliminado correctamente');
								  break;

                                   default:
                                   $( "#dialog-alta" ).dialog( "close" );
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

function editar(id)
{
	$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>usuarios/editar/"+id,
                          data:{"id_oficina":$("#sucursal").val(),
                          "id_roles":$("#rol").val(),
                          "user":$("#usuario").val(),
                          "password":$("#password").val(),
                          "email":$("#email").val(),
                          "nombre":$("#nombre_completo").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
							             // $("#ErrorListaProductos").fadeIn();
                                          //$("#ErrorListaProductos").html("Error al procesar los datos.");
                                          alert("Error al procesar los datos ");
										  break;
                               case "1": 
							      $( "#dialog-alta" ).dialog( "close" );
  								 // alert('editado');
								 // guardar_paciente(data);
								   reloading();
								  break;

                                   default:
                                   $( "#dialog-alta" ).dialog( "close" );
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


function reloading()
	{
	$("#tbl").trigger("reloadGrid")
	}

function alta() {

$("#nombre_grupo").val('');
$( "#dialog-alta" ).dialog({
			autoOpen: false,
			height: 320,
			width: 550,
			modal: true,
			buttons: {
					Aceptar: function() {
					guardar();
					
					},
					Cancelar:function()
					{		
				$( "#dialog-alta" ).dialog( "close" );
					}
			},
			close: function() {}
		});

				$( "#dialog-alta" ).dialog( "open" );
}

function guardar()
{
$.ajax({
                        async:true,cache: false,
                        beforeSend:function(objeto){$('#loading').html('<img src="<?php echo base_url();?>img/ajax-loader.gif" width="28" height="28" />');},
                         type:"POST",
                          url:"<?php echo base_url();?>usuarios/guardar?da="+Math.random()*2312,
                          data:{"id_oficina":$("#sucursal").val(),
                          "id_roles":$("#rol").val(),
                          "user":$("#usuario").val(),
                          "password":$("#password").val(),
                          "email":$("#email").val(),
                          "nombre":$("#nombre_completo").val()},

                     datatype:"html",
                      success:function(data, textStatus){

                             switch(data){
                               case "0": 
							              alert("Error al procesar los datos ");
										  break;
                              case "1": 
							            
					                     msg('El registro se ha guardado correctamente');
								         $( "#dialog-alta" ).dialog( "close" );
										  reloading();
										 break;

                                   default:
                                   $( "#dialog-alta" ).dialog( "close" );
   	              					alert("Error "+data);
								  break; 

                              }//switch
                             },
                        error:function(datos){
                              alert("Error inesperado");
                             }//Error
                         });//Ajax      
}
</script>

     <script type="text/javascript">   
    $(document).ready(function(){
	$("#tbl").jqGrid({
    url:'<?php echo base_url();?>usuarios/paginacion',
    datatype: "json",
    mtype: 'POST',
		
                        
						colNames:['ACCI&Oacute;N','NOMBRE','USUARIO','EMAIL','ROL'],
                        colModel:[
                        {name:'acciones', index:'acciones', width:100, resizable:false, align:"center", search:false},
                        {name:'nombre', index:'nombre', width:230,resizable:false, sortable:true,search:true,editable:true},
                        {name:'user', index:'user', width:180,resizable:false, sortable:true,search:true,editable:true},
                        {name:'email', index:'email', width:180,resizable:false, sortable:true,search:true,editable:true},
					             {name:'rol', index:'id_roles', width:120,resizable:false, sortable:true,search:true, stype:"select", searchoptions:{"value":":Seleccione;<?php $query=$this->db->query('select * from roles where status = 1 order by nombre_rol'); $q=$query->result_array(); $coma=';'; for($i=0; $i<count($q); $i++) { if($i==count($q)-1){$coma='';} echo $q[$i]['id_roles'].':'.$q[$i]['nombre_rol'].$coma; }?>"}}                       
                    ],
    pager: jQuery('#paginacion'),
    rownumbers:true,
	rowNum:15,
    rowList:[10,20,30],
    imgpath: '<?php echo base_url();?>img/editar.jpg',
    mtype: "POST",
    sortname: 'id',
    viewrecords: true,
    sortorder: "asc",
	editable: true,
    caption: 'Usuarios',
    multiselect: false,
    height:'auto',
	width:730,
    loadtext: 'Cargando',
    searchurl:'<?php echo base_url();?>usuarios/buscando',
                height:"100%"
        }).navGrid("#paginacion", { edit: false, add: false, search: false, del: false, refresh:true });
        $("#tbl").jqGrid('filterToolbar', { stringResult: true, searchOnEnter: false }) ; 
   });   
          			
        </script>
<table align="center"  width="90%">
<tr>
<td><div onclick="alta()" id="alta"><img src="<?php '.base_url().' ?>img/add_user.png" width="30" height="30"></div>
</td>
<td >&nbsp;</td>
</tr>
</table>
        
        
        
        <table id="tbl"></table>
        <div id="paginacion"> </div>
<div style="display:none" id="dialog-alta" title="Usuarios">
<?php $this->load->view('usuarios/alta');?>
</div>