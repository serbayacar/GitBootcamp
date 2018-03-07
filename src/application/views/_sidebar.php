

<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-closed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> <span></span> </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

                  <?php
                        $i=0;
                        if(isset($menus)){
                            $count=$menus[$i]["count"];
                            while ($i <$count-1){
                                 if(isset($menus[$i]["ust_menu_id"]))
                                 {
                                    if($menus[$i]["ust_menu_id"]== 0) {
                                        echo "<li class=\"nav-item start \"> <a href=\"javascript:;\" class=\"nav-link nav-toggle\"> <i class=\"".$menus[$i]["menu_icon"]."\"></i> <span class=\"title\">".$menus[$i]["name"]."</span> <span class=\"arrow\"></span> </a>";
                                        $i++;
                                    }
                                    else{
                                       echo "<ul class=\"sub-menu\"> ";
                                        while($menus[$i]["ust_menu_id"]!= 0 && $i <$count-1) {
                                            if(isset($menus[$i]["menu_url"]))
                                            {
                                                echo "<li class=\"nav-item start\"> <a href=\"".base_url().$menus[$i]["menu_url"]."\" class=\"nav-link \"> <i class=\"icon-bar-chart\"></i> <span class=\"title\">";
                                                echo $menus[$i]["name"];
                                                echo "</span> </a> </li>";
                                            }
                                            $i++;
                                        }
                                        echo "</ul>";
                                    }
                                 }

                            }

                        }


                     ?>

            <!--

             <li class="nav-item start "> <a href="javascript:;" class="nav-link nav-toggle"> <i class="icon-home"></i> <span class="title">Pickyfy</span> <span class="arrow"></span> </a>
                <ul class="sub-menu">
                   <?php
                    /*    foreach ($menus as $row){

                                echo "<li class=\"nav-item start \"> <a href=\"".base_url().$row["menu_url"]."\" class=\"nav-link \"> <i class=\"icon-bar-chart\"></i> <span class=\"title\">";
                                echo   $row["menu_name_txt"];
                                echo "</span> </a> </li>";


                        }
                      */
                     ?>


                </ul>
            </li>

            -->


        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

