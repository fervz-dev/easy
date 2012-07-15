<?php $this->load->view('header');?>
<?php $this->load->view('menu_up');?>
<?php $this->load->view('session_user');?>
<?php $this->load->view('messages');?>
<?php $this->load->view('menu_izquierdo');?>
<div class="content">
<script type="text/javascript">
	function notify(msg,speed,fadeSpeed,type){

       //Borra cualquier mensaje existente
       $('.notify').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof fade != "undefined"){
           clearTimeout(fade);
       }

       //Creamos la notificación con la clase (type) y el texto (msg)
       $('body').append('<div class="notify '+type+'" style="display:none;position:fixed;right: 10px;"><p>'+msg+'</p></div>');

       //Calculamos la altura de la notificación.
       notifyHeight = $('.notify').outerHeight();

       //Creamos la animación en la notificación con la velocidad
       //que pasamos por el parametro speed
       $('.notify').css('top',-notifyHeight).animate({top:30,opacity:'toggle'},speed);

       //Creamos el temporizador para hacer desaparecer la notificación
       //con el tiempo almacenado en el parametro fadeSpeed
       fade = setTimeout(function(){

           $('.notify').animate({top:notifyHeight+10,opacity:'toggle'}, speed);

       }, fadeSpeed);

   }
    function notify_campos(msg,speed,fadeSpeed,type){

       //Borra cualquier mensaje existente
       $('.notify_campos').remove();

       //Si el temporizador para hacer desaparecer el mensaje está
       //activo, lo desactivamos.
       if (typeof fade != "undefined"){
           clearTimeout(fade);
       }

       //Creamos la notificación con la clase (type) y el texto (msg)
       $('#footer').append('<div class="notify_campos '+type+'" style="display:none;position:fixed;right: 10px;"><p>'+msg+'</p></div>');

       //Calculamos la altura de la notificación.
       notifyHeight = $('.notify_campos').outerHeight();

       //Creamos la animación en la notificación con la velocidad
       //que pasamos por el parametro speed
       $('.notify_campos').css('footer',-notifyHeight).animate({bottom:45,opacity:'toggle'},speed);

       //Creamos el temporizador para hacer desaparecer la notificación
       //con el tiempo almacenado en el parametro fadeSpeed
       fade = setTimeout(function(){

           $('.notify_campos').animate({bottom:0,opacity:'toggle'}, speed);

       }, fadeSpeed);

   }
    $('#error').click(function(){
        notify_campos('Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>Ha ocurrido un error inesperado<br/>',500,5000,'error');
        return false;
   });

</script>
				<?php //$this->load->view('login/acceso');?>
				<?php $this->load->view($vista); ?>
			</div>
   		</div>
	</div>
<?php $this->load->view('footer');?>a