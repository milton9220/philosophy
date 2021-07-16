<?php

     $philosophy_audio_file="";
     if(function_exists("the_field")){
        $philosophy_audio_file=get_field("source_file");
     }

?>
<article class="masonry__brick entry format-audio" data-aos="fade-up">

<div class="entry__thumb">
    <a href="single-audio.html" class="entry__thumb-link">
        <?php the_post_thumbnail("philosophy-square-size"); ?>
    </a>
    <div class="audio-wrap">
    <?php if($philosophy_audio_file):?>
        <audio id="player" src="<?php echo esc_url($philosophy_audio_file); ?>" width="100%" height="42" controls="controls"></audio>
        <?php endif; ?>
    </div>
</div>

<?php get_template_part("template-parts/common/post/summary"); ?>
</article> <!-- end article -->
