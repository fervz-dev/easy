
<div id="header">
<img alt="Logo" src="<?php echo base_url();?>img/logo.png" />
      
<!--  Menus -->
<div id="tabsMain" class="">
    <ul>
       <?php 
       	$menu_query=$this->db->query("select * from menu_principal where activo = 1 order by orden asc");
	  	   foreach($menu_query ->result_array() as $menu)
	  		{
	   			if($_GET['m'] == $menu['id_menu'])
	   				{
	  					$class="class='active'";
	    				$titulo_men=$menu['titulo_menu'];
	  		 		}
	   			else
	   				{
	   					$class="";
	   				}
	   ?>

       <li <?php echo $class;?> ><a class="txt" href="<?php echo base_url().$menu['url'];?>?m=<?php echo $menu['id_menu'];?>"><span><?php echo $menu['titulo_menu'];?></span></a></li>
       <?php } ?>
    </ul>
</div>        