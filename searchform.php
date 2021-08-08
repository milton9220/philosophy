<?php 

$homedir=home_url("/");
$post_type=<<<PT
<input type="hidden" name="post_type" value="post">
PT;

?>
<?php if(is_post_type_archive("book")){
    $post_type=<<<PT
    <input type="hidden" name="post_type" value="book">
    PT;
} ?>
<form role="search" method="get" class="header__search-form" action="<?php echo $homedir; ?>">
                        <label>
                            <span class="hide-content"><?php _e("Search for:","philosophy"); ?></span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="<?php _e("Search for:","philosophy"); ?>" autocomplete="off">
                        </label>
                        <?php echo $post_type; ?>
                        <input type="submit" class="search-submit" value="<?php _e("Search","philosophy"); ?>">
</form>