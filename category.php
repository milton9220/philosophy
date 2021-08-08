<?php do_action("philosphy_category_page",single_cat_title('',false)); 
//upore philosopy_category_page ekta action hook define kore rakha hola
//eikhane single_term_title ekta build in function jeta ki na single page r category ar name show kore. r false diya hoise jate ei single_term_title function echo na kore value return kore.
// single_term_title ta philosopy_category_page action hook r parameter hisebe define kora
?>
 <?php get_header(); ?>

    <!-- s-content
    ================================================== -->
    <section class="s-content">
    <div class="row narrow">
            <div class="col-full s-content__header" data-aos="fade-up">
                <?php echo apply_filters("philosophy_something_text","Hellow"); ?>
                <?php do_action("before_category_title"); ?>
                
                <?php single_term_title(); ?>

                <h1><?php single_cat_title(); ?></h1>

                <?php do_action("after_category_title"); ?>
                <p class="lead"><?php echo category_description(); ?></p>
            </div>
        </div>
        <div class="row masonry-wrap">
            <div class="masonry">

                <div class="grid-sizer"></div>
                <?php 
                
                    if(!have_posts()):?>
                        <h2><?php _e("This Category doesn\'t has post","philosophy"); ?></h2>
                    <?php endif; ?>
                
               
                <?php while(have_posts()){
                    the_post();
                    get_template_part("template-parts/post-formats/post",get_post_format());
                } ?>
       

            </div> <!-- end masonry -->
        </div> <!-- end masonry-wrap -->

        <div class="row">
            <div class="col-full">
                <nav class="pgn">
                   
                    <?php
                   
                     philosophy_pagination();
                    
                    ?>
                   
                </nav>
            </div>
        </div>

    </section> <!-- s-content -->


    <?php get_footer(); ?>