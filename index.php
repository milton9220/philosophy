
 <?php get_header(); ?>

    <!-- s-content
    ================================================== -->
    <section class="s-content">
        
        <div class="row masonry-wrap">
        <?php if(!have_posts()):?>
                    <h2 class="text-center">There have no post</h2>
                 <?php endif; ?>
            <div class="masonry">
               
                <div class="grid-sizer"></div>

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