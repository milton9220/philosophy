<?php 
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
                <ul class="s-content__header-meta">
                    <li class="date"><?php the_date(); ?></li>
                    <li class="cat">
                        In
                        <?php echo get_the_category_list(' '); ?>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <?php the_post_thumbnail("large" ); ?>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

               <?php the_content(); ?>
               <?php $philosophy_page_meta_content=get_post_meta(get_the_ID(),'page-metabox',true);?>
               <?php $philosophy_page_upload_files=get_post_meta(get_the_ID(),'page-metabox2',true);?>
               
                <?php echo  $philosophy_page_upload_files['fieldset_1']['fieldset_1_text'];?>
                <br>
               <a download href="<?php echo esc_url($philosophy_page_upload_files['file_upload']); ?>">Download CV</a>
                   
                <h2><?php echo esc_html($philosophy_page_meta_content['page-heading']); ?></h2>
                <p><?php echo esc_html($philosophy_page_meta_content['page-excerpt']); ?></p>

                <?php 
                echo wp_get_attachment_image($philosophy_page_upload_files['image_upload'],'full');
                

                $philosophy_gallery=explode(",",$philosophy_page_upload_files['gallery_upload']);
                
                ?>

               <pre>
                   <?php print_r($philosophy_page_upload_files); ?>
               </pre>
                
                <div class="repeater-field">
                    <?php 
                     if($philosophy_page_upload_files['repeatar']){
                       foreach($philosophy_page_upload_files['repeatar'] as $item){
                          echo $item['text1']."</br>";
                          echo $item['file']."</br>";
                          echo $item['switch']."</br>";
                       }
                    }
                    ?>
                </div>
                <?php if($philosophy_page_meta_content['is_favt']){ ?>
                    <p><?php echo esc_html($philosophy_page_meta_content['is_favt_text']); ?></p>
                <?php } ?>

                <div class="slider">
                    <?php foreach($philosophy_gallery as $item): ?>
                        <div>
                            <?php echo wp_get_attachment_image($item,'full'); ?>
                        </div>
                     <?php endforeach ; ?>   
                </div>

                <p class="s-content__tags">
                    <span>Post Tags</span>

                    <span class="s-content__tag-list">
                        <?php echo get_the_tag_list( ' ') ?>
                    </span>
                </p> <!-- end s-content__tags -->

                <div class="s-content__author">
                    <?php echo get_avatar(get_the_author_meta("ID")) ?>

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta("ID") );?>"><?php the_author(); ?></a>
                        </h4>
                    
                        <p><?php the_author_meta("description")  ?>
                        </p>

                        <ul class="s-content__author-social">
                        <?php 
                        
                            $philosophy_facebook_author=get_field("facebook","user_".get_the_author_meta("ID"));
                            $philosophy_twitter_author=get_field("twitter","user_".get_the_author_meta("ID"));
                            $philosophy_instagram_author=get_field("instagram","user_".get_the_author_meta("ID"));

                            
                        
                        ?>
                        <?php if($philosophy_facebook_author){?>
                           <li><a href="<?php echo esc_url($philosophy_facebook_author); ?>">Facebook</a></li>
                         <?php } if($philosophy_twitter_author){?>  
                           <li><a href="<?php echo esc_url($philosophy_twitter_author); ?>">Twitter</a></li>
                          <?php } if($philosophy_instagram_author){?>
                           <li><a href="<?php echo esc_url($philosophy_instagram_author); ?>">Instagram</a></li>
                           <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="s-content__pagenav">
                    <div class="s-content__nav">
                     <?php $philosophy_prev_post= get_previous_post();
                       if($philosophy_prev_post):
                     ?>
                       
                        <div class="s-content__prev">
                            <a href="<?php echo get_the_permalink($philosophy_prev_post); ?>" rel="prev">
                                <span><?php _e("Previous Post","philosophy"); ?></span>
                                <?php echo  get_the_title($philosophy_prev_post); ?> 
                            </a>
                        </div>
                      <?php endif; ?>
                      <?php  $philosophy_next_post= get_next_post();
                       if($philosophy_next_post):?>  
                        <div class="s-content__next">
                            <a href="<?php get_the_permalink($philosophy_next_post); ?>" rel="next">
                                <span><?php _e("Next Post","philosophy"); ?></span>
                                <?php echo get_the_title($philosophy_next_post); ?> 
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div> <!-- end s-content__pagenav -->

            </div> <!-- end s-content__main -->

        </article>


        <?php 
         
          if(!post_password_required()){
              comments_template();
          }
        
        ?>

    </section> <!-- s-content -->


    <?php get_footer(); ?>