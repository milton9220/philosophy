<?php
require_once(get_theme_file_path('inc/tgm.php'));
require_once(get_theme_file_path('inc/attachments.php'));
require_once( get_theme_file_path( "/widgets/social-icons-widget.php" ) );

if(site_url()=='http://localhost/alpha'){
    define("VERSION",time());
}
else{
    define("VERSION",wp_get_theme()->get("Version"));
}

function philosophy_theme_setup(){
    load_theme_textdomain("philosophy");
    add_theme_support("post-thumbnails");
    add_theme_support("title-tag");
    add_theme_support( 'html5', array( 'search-form','comment-list' ));
    add_theme_support("post-formats",array("image","gallery","video","audio","quote","link"));

    add_editor_style("/assets/css/editor-style.css");

    register_nav_menu("topmenu",__("Top Menu","philosophy"));
    register_nav_menus(array(

        "footer-left"=>__("Footer Left Menu","philosophy"),
        "footer-social"=>__("Footer Social Menu","philosophy"),

    ));

    add_image_size("philosophy-square-size",400,400,true);
}

add_action("after_setup_theme","philosophy_theme_setup");

function philosopy_assets(){
    wp_enqueue_style("font-awesome",get_theme_file_uri("/assets/css/font-awesome/css/font-awesome.css"),null,"1.0");
    wp_enqueue_style("fonts-css",get_theme_file_uri("/assets/css/font.css"),null,"1.0");
    wp_enqueue_style("base-css",get_theme_file_uri("/assets/css/base.css"),null,"1.0");
    wp_enqueue_style("vendor-css",get_theme_file_uri("/assets/css/vendor.css"),null,"1.0");
    wp_enqueue_style("main-css",get_theme_file_uri("/assets/css/main.css"),null,VERSION);

    wp_enqueue_style("philosophy-css",get_stylesheet_uri(),null,VERSION);

    wp_enqueue_script("modernizr-js",get_theme_file_uri("/assets/js/modernizr.js"),null,"1.0");
    wp_enqueue_script("pace-js",get_theme_file_uri("/assets/js/pace.min.js"),null,"1.0");
    wp_enqueue_script("plugins-js",get_theme_file_uri("/assets/js/plugins.js"),array("jquery"),"1.0",true);
    wp_enqueue_script("main-js",get_theme_file_uri("/assets/js/main.js"),array("jquery"),VERSION,true);
}
add_action("wp_enqueue_scripts","philosopy_assets");

function philosophy_admin_assets($hook){
    
    if(isset($_REQUEST['post']) || isset($_REQUEST['post_ID'])){
		$post_id=empty($_REQUEST['post_ID']) ? $_REQUEST['post']:$_REQUEST['post_ID'];
	}

    if('post.php'==$hook){
        $post_format=get_post_format($post_id);
       
        wp_enqueue_script("admin-js",get_theme_file_uri('/assets/js/admin.js'),array('jquery'),VERSION,true);
        wp_localize_script("admin-js","philosophy_pf",array("format"=>$post_format));
    }
    

}
add_action("admin_enqueue_scripts","philosophy_admin_assets");

function philosophy_pagination(){
    global $wp_query;
    
    $links= paginate_links(array(
        'current'       =>max(1,get_query_var('paged')),
        'total'         =>$wp_query->max_num_pages,
        'type'          =>'list',
        'mid_size'           =>2,

    ));

    $links=str_replace("page-numbers","pgn__num",$links);
    $links=str_replace("<ul class='pgn__num'>","<ul>",$links);
    $links=str_replace("next pgn__num","pgn__next",$links);
    $links=str_replace("prev pgn__num","pgn__prev",$links);

    echo $links;
}
remove_action("term_description","wpautop");

function philosophy_widget() {
    register_sidebar( array(
        'name'          => __( 'Aboust Us Page', 'philosophy' ),
        'id'            => 'about-us',
        'description'   => __( 'About Us page Widgets', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="quarter-top-margin">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Contact Page Maps Section', 'philosophy' ),
        'id'            => 'google-maps',
        'description'   => __( 'Widgets in this area will be shown on contact page ', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
    register_sidebar( array(
        'name'          => __( 'Contact Page Information', 'philosophy' ),
        'id'            => 'contact-info',
        'description'   => __( 'Widgets in this area will be shown on contact page ', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="quarter-top-margin">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer About Section', 'philosophy' ),
        'id'            => 'footer-about',
        'description'   => __( 'Widgets in this area will be shown on footer about area ', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Middle Widget Section', 'philosophy' ),
        'id'            => 'footer-middle',
        'description'   => __( 'Widgets in this area will be shown on footer  area ', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="s-footer__linklist %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Newsletter Widget Section', 'philosophy' ),
        'id'            => 'footer-newsletter',
        'description'   => __( 'Widgets in this area will be shown on footer about area ', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class=" %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ) );
}

add_action( 'widgets_init', 'philosophy_widget' );

function before_cat_title_hook(){
    echo "<h4>Before Category title</h4>";
}

add_action("before_category_title","before_cat_title_hook");

remove_action("before_category_title","before_cat_title_hook");

function after_cat_title_hook(){
    echo "<h4>After Category title</h4>";
}

add_action("after_category_title","after_cat_title_hook");

//ekta category te kotojon visitor asche seta dekhar jonno category.php te jei action hook ta define kora hoise oita use korbo

function beginning_category_page( $category_title ) {
    if ( "Music" == $category_title ) {
        $visit_count = get_option( "category_music" );
        $visit_count = $visit_count ? $visit_count : 0;
        $visit_count ++;
        update_option( "category_music", $visit_count );
    }
}

add_action( "philosphy_category_page", "beginning_category_page" );

function change_something_text($text){
    return strtoupper($text)." "."World";
   
}
add_filter("philosophy_something_text","change_something_text");

function philosophy_home_class_dynamic($class_name){
    if(is_home()){
        return $class_name;
    }
    else{
        return "";
    }
}
add_filter("philosophy_home_class","philosophy_home_class_dynamic");

//post type r slug change korar jonno

function philosophy_cpt_slug_fix($post_link,$post_id){
    $p=get_post($post_id);
    if(is_object($p) && 'chapter'==get_post_type($post_id)){
        $parent_post_id=get_field("parent_book");
        $parent_post=get_post($parent_post_id);
        if($parent_post){
            $post_link=str_replace("%book%",$parent_post->post_name,$post_link);
        }
        return $post_link;
    }
}
add_filter("post_type_link","philosophy_cpt_slug_fix",1,2);

