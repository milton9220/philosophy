<?php 

$featured_posts=new WP_Query(
    array(

        'meta_key'              =>'featured',
        'meta_value'            =>'1',
        'posts_per_page'        =>3

    )
);
$posts_data=array();
while($featured_posts->have_posts()){
    $featured_posts->the_post();
    $categories[]=get_the_category();
    $posts_data[]=array(
        "title"=>get_the_title(),
        "date"=>get_the_date(),
        "thumbnail"=>get_the_post_thumbnail_url(get_the_ID(),"large"),
        "author" =>get_the_author_meta("display_name"),
        "author_avatar"=>get_avatar_url(get_the_author_meta("ID")),
        "permalink" =>get_the_permalink(),
        "author_url"=>get_author_posts_url(get_the_author_meta("ID"))

    );
}
$total_post=$featured_posts->found_posts;?>




 <?php if($featured_posts->post_count>1){
?>
 <div class="pageheader-content row">
            <div class="col-full">

                <div class="featured">

                    <div class="featured__column featured__column--big">
                        <div class="entry" style="background-image:url('<?php echo esc_url($posts_data[0]['thumbnail']); ?>);">
                            
                            <div class="entry__content">
                                <span class="entry__category">
                                
                                <?php for($i=0;$i<1;$i++){
                                        for($j=0;$j<count($categories[$i]);$j++){?>

                                        <a href="<?php echo get_category_link($categories[$i][$j]->cat_ID); ?>"><?php echo $categories[$i][$j]->name."</br>";?></a>
                                            
                                       <?php }
                                    }
                                    
                                    ?>
                                
                                </span>

                                <h1><a href="<?php echo esc_url($posts_data[0]['permalink']); ?>" title=""><?php echo esc_html($posts_data[0]['title']); ?></a></h1>

                                <div class="entry__info">
                                    <a href="<?php echo esc_url($posts_data[0]['author_url']); ?>" class="entry__profile-pic">
                                        <img class="avatar" src="<?php echo esc_url($posts_data[0]['author_avatar']); ?>" alt="">
                                    </a>

                                    <ul class="entry__meta">
                                        <li><a href="<?php echo esc_url($posts_data[0]['author_url']); ?>"><?php echo esc_html($posts_data[0]['author']); ?></a></li>
                                        <li><?php echo esc_html($posts_data[0]['date']); ?></li>
                                    </ul>
                                </div>
                            </div> <!-- end entry__content -->
                            
                        </div> <!-- end entry -->
                    </div> <!-- end featured__big -->

                    <div class="featured__column featured__column--small">
                        <?php 
                            $i=1;
                            for($i=1;$i<3;$i++){

                                if($i==$total_post){
                                    break;  
                                }
                            ?>     
                                <div class="entry" style="background-image:url('<?php echo esc_url($posts_data[$i]['thumbnail']); ?>);">
                            
                                <div class="entry__content">
                                    <span class="entry__category">
   
                                       <?php for($j=0;$j<count($categories[$i]);$j++){?>

                                        <a href="<?php echo get_category_link($categories[$i][$j]->cat_ID); ?>"><?php echo $categories[$i][$j]->name."</br>";?></a>
                                            
                                    <?php }
                                    
                                    
                                    ?>
                                    
                                    </span>
    
                                    <h1><a href="<?php echo esc_url($posts_data[$i]['permalink']); ?>" title=""><?php echo esc_html($posts_data[$i]['title']); ?></a></h1>
    
                                    <div class="entry__info">
                                        <a href="<?php echo esc_url($posts_data[$i]['author_url']); ?>" class="entry__profile-pic">
                                            <img class="avatar" src="<?php echo esc_url($posts_data[$i]['author_avatar']); ?>" alt="">
                                        </a>
    
                                        <ul class="entry__meta">
                                            <li><a href="<?php echo esc_url($posts_data[$i]['author_url']); ?>"><?php echo esc_html($posts_data[$i]['author']); ?></a></li>
                                            <li><?php echo esc_html($posts_data[0]['date']); ?></li>
                                        </ul>
                                    </div>
                                </div> <!-- end entry__content -->
                                
                            </div> <!-- end entry -->
                        <?php    }
                       ?>
                    </div> <!-- end featured__small -->
                </div> <!-- end featured -->

            </div> <!-- end col-full -->
        </div> <!-- end pageheader-content row -->       
<?php } ?>        