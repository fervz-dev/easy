
<!-- Menu izquierdo -->
<?php 
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
                          foreach ($query_sub->result_array() as $rows) {
                            if ($rows['url_submenu']=='') {
                              $url="#";

                            }else{
                              $url=base_url().$rows['url_submenu'];
                            }
                             
                          ?>
                          <li><a href="<?php echo $url; ?>?m=<?php echo $rows['id_menu']; ?>&submain=<?php echo $rows['id_submenu']; ?>"><?php echo $rows['titulo_submenu'] ;?></a></li> 
                          <?php } ?>
                    </ul>
                    
                </div>
          </div>
        </div>