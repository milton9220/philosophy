<?php
/**
 * Template Name: Custom Tax Query
 */

 $philosophy_tax_query=array(
     'post_type'        =>'book',
     'posts_per_page'   =>-1,
     'tax_query'       =>array(
         'relation' =>'AND',
            array(
                'taxonomy'  =>'language',
                'field'     =>'slug',
                'terms'     =>array('urdu','hindi')
            ),
            array(
                'taxonomy'  =>'language',
                'field'     =>'slug',
                'terms'     =>array('hindi','english'),
                'operator' =>"NOT IN" 
            )
        )
    );
$philosophy_post=new WP_Query($philosophy_tax_query);
while($philosophy_post->have_posts()):$philosophy_post->the_post()?>

<h2><?php the_title(); ?></h2>

<?php endwhile; ?>
