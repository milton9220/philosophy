<?php 

$homedir=home_url("/");


?>

<form role="search" method="get" class="header__search-form" action="<?php echo $homedir; ?>">
                        <label>
                            <span class="hide-content"><?php _e("Search for:","philosophy"); ?></span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="<?php _e("Search for:","philosophy"); ?>" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="<?php _e("Search","philosophy"); ?>">
</form>