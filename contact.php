<?php 

/**
 * 
 * Template Name:Contact Page 
 */

    the_post();
    get_header();
 ?>   <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-standard">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php the_title(); ?>
                </h1>
               
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <?php the_post_thumbnail("large" ); ?>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <div class="mb-5">
                    <?php if ( is_active_sidebar( 'google-maps' ) ) { ?>
                            <?php dynamic_sidebar('google-maps'); ?>
                    <?php } ?>
                </div>
               <?php the_content(); ?>

               <div class="row block-1-2 block-tab-full">
                    <?php if ( is_active_sidebar( 'contact-info' ) ) { ?>
                            <?php dynamic_sidebar('contact-info'); ?>
                    <?php } ?>
               </div>

               <h3>Say Hellow</h3>
               <div>
                   <?php if(get_field("contact-form-shotcode")){
                       echo do_shortcode(get_field("contact-form-shotcode"));
                   } ?>
               </div>

            </div> <!-- end s-content__main -->

        </article>



    </section> <!-- s-content -->


    <?php get_footer(); ?>