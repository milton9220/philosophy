<?php
/**
 * Template Name: Custom Post Archive Page
 */

 
 get_header(); ?>

<!-- s-content
================================================== -->
<section class="s-content">
    
    <div class="row masonry-wrap">
    <h2 class="text-center">All Books</h2>
        <div class="masonry">
            
            <div class="grid-sizer"></div>
            <?php 
                $paged=get_query_var('paged')?get_query_var('paged'):1;
                
                $book_args=array(
                    'post_type'             =>'book',
                    'posts_per_page'        =>4,
                    'paged'                 =>$paged
                );
                $posts=new WP_Query($book_args);
                
            ?>
            
            <?php while($posts->have_posts()){
                $posts->the_post();
                get_template_part("template-parts/post-formats/post",get_post_format());
            }
             ?>
   

        </div> <!-- end masonry -->
    </div> <!-- end masonry-wrap -->

    <div class="row">
        <div class="col-full">
            <nav class="pgn">
            
                <?php
               
                echo paginate_links(array(
                    'current'       =>$paged,
                    'total'         =>$posts->max_num_pages,
                    'prev_next'     =>false
                ));
                
                ?>
               
            </nav>
        </div>
    </div>

</section> <!-- s-content -->


<?php get_footer(); ?>