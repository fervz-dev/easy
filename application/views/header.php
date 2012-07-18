<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- estilo -->
<link type="text/css" rel="stylesheet"  href="<?php echo base_url();?>css/styles_login.css" />
<!-- JQGrid -->
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery_numberformat.js"></script>
<link type="text/css" href="<?php echo base_url();?>css/custom-theme/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<!-- estilo JQGrid -->
<!-- <link type="text/css" href="<?php echo base_url();?>css/start/jquery-ui-1.8.20.custom.css" rel="stylesheet" /> -->
<!-- <link type="text/css" href="<?php echo base_url();?>css/blitzer/jquery-ui-1.8.20.custom.css" rel="stylesheet" /> -->

<!-- <link type="text/css" href="<?php echo base_url();?>css/cupertino/jquery-ui-1.8.20.custom.css" rel="stylesheet" /> -->
<!-- <link type="text/css" rel="stylesheet"  href="<?php echo base_url();?>css/ui/demos.css" />
 -->
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache"> 

<script type="text/javascript">
	/*function str_replace(busca, repla, orig)
	{
		str 	= new String(orig);

		rExp	= "/"+busca+"/g";
		rExp	= eval(rExp);
		newS	= String(repla);

		str = new String(str.replace(rExp, newS));

		return str;
	}
	*/
	// Mensajes
	function msg(mensaje){
	$("#mensajes").html(mensaje);
	$("#mensajes_0").fadeIn();
	}

		// Calendario
	$(function($){
		$.datepicker.regional["es"] = {
		closeText: "Cerrar",
			prevText: "&#x3c;Ant",
			nextText: "Sig&#x3e;",
			currentText: "Hoy",
			monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio",
			"Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
			monthNamesShort: ["Ene","Feb","Mar","Abr","May","Jun",
			"Jul","Ago","Sep","Oct","Nov","Dic"],
			dayNames: ["Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado"],
			dayNamesShort: ["Dom","Lun","Mar","Mi&eacute;","Juv","Vie","S&aacute;b"],
			dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","S&aacute;"],
			weekHeader: "Sm",
			dateFormat: "yy-mm-dd",
			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: true,
			changeYear: true,
	    yearSuffix: ""};
		$.datepicker.setDefaults($.datepicker.regional["es"]);
		});    
        $(document).ready(function() {
           
           $("#fecha_entrega").datepicker({ changeMonth: true });
           $("#fecha_nacimiento").datepicker({ changeMonth: true });
           
        });
		function oculta(id)
		{
		$(id).fadeOut();
		}	

    </script>
    <!-- local gen ES -->
<script src="<?php echo base_url();?>jqgrid/js/i18n/grid.locale-es.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url();?>jqgrid/css/ui.jqgrid.css" />

<!-- Titulo de la pagina -->
<title><?php if(isset($titulo)){echo $titulo;}?></title>
</head>
<body>
