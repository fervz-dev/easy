
<!-- Menu izquierdo -->

<div id="wrapper-main">
    <div id="main" >
    <div class="sidebar-left">
          <div >
              <div  id="menu_"style=" background-color:#f6fafc; width:96%;
                                      -webkit-border-radius: 20px;
                                      -webkit-border-bottom-left-radius: 2px;
                                      -moz-border-radius: 20px;
                                      -moz-border-radius-bottomleft: 2px;

                                      border-radius: 20px;
                                      border-bottom-left-radius: 2px;
                                      width:98%;
                                      min-height:310px;
                                      margin-left:2%;
                                      margin-top:24px;

                                      border: #12c3ec solid 1px;
                                      text-align:left;
                                      padding: 6px 4px 4px 4px;">

                    <ul>
<?php
if (!is_numeric($_GET['m']) && $_GET['m']!='inicio') {
  redirect(base_url().'inicio/logout');
}

if ($_GET['m']=='inicio') {

}elseif (is_numeric($_GET['m'])){
$query_sub=$this->db->query("SELECT
submenus.titulo_submenu,
submenus.url_submenu,
menu_principal.titulo_menu,
submenus.id_menu,
submenus.id_submenu
FROM
submenus ,
menu_principal
WHERE
submenus.id_menu = ".$_GET['m']." AND
submenus.activo_submenu = 1 AND
menu_principal.id_menu = submenus.id_menu
ORDER BY
submenus.orden_submenu ASC
");
  $row =  $query_sub->row();

?>
        <?php
$str=base_url();
$uno=(explode('/', $str));
$baseUrl= 'http:'.'//'.$uno[2].$_SERVER['REQUEST_URI'];
          foreach ($query_sub->result_array() as $rows) {
            if ($this->permisos->permisosArray($rows['id_submenu'])==1) {

              if (($this->permisos->permisos($rows['id_submenu'],0)==1)||($this->permisos->permisos($rows['id_submenu'],1)==1)||($this->permisos->permisos($rows['id_submenu'],2)==1)||($this->permisos->permisos($rows['id_submenu'],3)==1) )
              {
                if ($rows['url_submenu']=='') {
                  $url="#";
                }else{

                  $url=base_url().$rows['url_submenu'];
                }


                  $urlActiva=$url.'?m='.$rows['id_menu'].'&submain='.$rows['id_submenu'];
                  if ($baseUrl==$urlActiva) {
                ?>
                <li><a class="activo" href="<?php echo $url; ?>?m=<?php echo $rows['id_menu']; ?>&submain=<?php echo $rows['id_submenu']; ?>"><?php echo $rows['titulo_submenu'] ;?></a></li>
                <?php }else{

                  ?>
              <li><a href="<?php echo $url; ?>?m=<?php echo $rows['id_menu']; ?>&submain=<?php echo $rows['id_submenu']; ?>"><?php echo $rows['titulo_submenu'] ;?></a></li>
              <?php
              }
            }
          }
        }
      }
        ?>
      </ul>
    </div>
  </div>
</div>

