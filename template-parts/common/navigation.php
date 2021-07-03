<a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <h2 class="header__nav-heading h6">Site Navigation</h2>

                    <?php 
                    
                       $philosophy_menu= wp_nav_menu(array(

                            'theme_location'    =>"topmenu",
                            "menu_id"           =>"topmenu",
                            'menu_class'        =>"header__nav",
                            "echo"              =>false

                        ));
                        $philosophy_menu=str_replace("menu-item-has-children","menu-item-has-children has-children",$philosophy_menu);
                        echo $philosophy_menu;
                    ?>


                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->