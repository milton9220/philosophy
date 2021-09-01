<?php
define( 'CS_ACTIVE_FRAMEWORK', true );
define( 'CS_ACTIVE_METABOX', true );
define( 'CS_ACTIVE_TAXONOMY', true );
define( 'CS_ACTIVE_SHORTCODE', true );
define( 'CS_ACTIVE_CUSTOMIZE', false );
define( 'CS_ACTIVE_LIGHT_THEME', true );

function philosophy_csf_matabox() {
    CSFramework_Metabox::instance( array() );
    CSFramework_Shortcode_Manager::instance( array() );
    CSFramework_Taxonomy::instance( array() );
}

add_action( 'init', 'philosophy_csf_matabox' );

function philosophy_meta_box( $options ) {
    $options[] = array(
        'id'        => 'page-metabox',
        'title'     => 'Page Meta Info',
        'icon'      => 'fa fa-heart',
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page-section1',
                'type'   => 'text',
                'title'  => 'Page Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'      => 'page-heading',
                        'type'    => 'text',
                        'title'   => __( 'Page Heading', 'philosophy' ),
                        'default' => __( 'Page Heading', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'page-excerpt',
                        'type'    => 'textarea',
                        'title'   => __( 'Page Heading', 'philosophy' ),
                        'default' => __( 'Page Excerpt', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'is_favt',
                        'title'   => __( 'Is Favourite', 'philosophy' ),
                        'type'    => 'switcher',
                        'default' => 0,
                    ),
                    array(
                        'id'      => 'is_favt_extra',
                        'title'   => __( 'Extra Favourite', 'philosophy' ),
                        'type'    => 'switcher',
                        'default' => 0,
                    ),
                    array(
                        'id'         => 'is_favt_text',
                        'title'      => __( 'Favourite Text', 'philosophy' ),
                        'type'       => 'text',
                        'dependency' => array( 'is_favt|is_favt_extra', '==|==', '1|1' ),
                    ),
                    array(
                        'id'         => 'langauge',
                        'type'       => 'checkbox',
                        'title'      => 'Supported Language',
                        'options'    => array(
                            'english' => 'English',
                            'bangla'  => 'Bangla',
                            'hindi'   => 'Hindi',
                        ),
                        'attributes' => array(
                            'data-depend-id' => 'langauge',
                        ),
                    ),
                    array(
                        'id'         => 'is_favt_text2',
                        'title'      => __( 'Favourite Text 2', 'philosophy' ),
                        'type'       => 'text',
                        'dependency' => array( 'langauge', 'any', 'english,bangla' ),
                    ),
                ),
            ),
            array(
                'name'   => 'page-section2',
                'type'   => 'text',
                'title'  => 'Extra Settings',
                'icon'   => 'fa fa-book',
                'fields' => array(
                    array(
                        'id'      => 'page-heading2',
                        'type'    => 'text',
                        'title'   => __( 'Page Heading2', 'philosophy' ),
                        'default' => __( 'Page Heading', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'page-excerpt2',
                        'type'    => 'textarea',
                        'title'   => __( 'Page Heading2', 'philosophy' ),
                        'default' => __( 'Page Excerpt', 'philosophy' ),
                    ),
                    array(
                        'id'      => 'is_favt2',
                        'title'   => __( 'Is Favourite2', 'philosophy' ),
                        'type'    => 'switcher',
                        'default' => 1,
                    ),
                ),
            ),
        ),

    );

    return $options;
}

add_filter( 'cs_metabox_options', 'philosophy_meta_box' );

function philosophy_custom_post( $options ) {

    $page_id = 0;

    if ( isset( $_REQUEST['post'] ) || isset( $_REQUEST['post_ID'] ) ) {
        $page_id = empty( $_REQUEST['post_ID'] ) ? $_REQUEST['post'] : $_REQUEST['post_ID'];
    }

    $options[] = array(

        'id'        => 'page-custom_post_metabox',
        'title'     => 'Select Post Type',
        'icon'      => 'fa fa-heart',
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page-custom-post-section',
                'type'   => 'text',
                //'title' => 'Page Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'      => 'cpt_option',
                        'type'    => 'select',
                        'title'   => 'Select a custom post type',
                        'options' => array(
                            'none'    => 'None',
                            'book'    => 'Book',
                            'chapter' => 'Chapter',
                        ),
                    ),

                ),
            ),
        ),

    );
    $page_meta_info = get_post_meta( $page_id, 'page-custom_post_metabox', true );

    if ( isset( $page_meta_info['cpt_option'] ) && $page_meta_info['cpt_option'] == 'book' ) {
        $options[] = array(

            'id'        => 'page-custom_post_metabox2',
            'title'     => 'Book Cpt Options',
            'icon'      => 'fa fa-heart',
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => array(
                array(
                    'name'   => 'page-custom-post-section2',
                    'type'   => 'text',
                    //'title' => 'Page Settings',
                    'icon'   => 'fa fa-image',
                    'fields' => array(
                        array(
                            'id'    => 'cpt_option2',
                            'type'  => 'text',
                            'title' => 'Cpt Info',
                        ),

                    ),
                ),
            ),

        );
    }

    if ( isset( $page_meta_info['cpt_option'] ) && $page_meta_info['cpt_option'] == 'chapter' ) {
        $options[] = array(

            'id'        => 'page-custom_post_metabox3',
            'title'     => 'Chapter Cpt Options',
            'icon'      => 'fa fa-heart',
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'default',
            'sections'  => array(
                array(
                    'name'   => 'page-custom-post-section3',
                    'type'   => 'text',
                    //'title' => 'Page Settings',
                    'icon'   => 'fa fa-image',
                    'fields' => array(
                        array(
                            'id'    => 'cpt_option3',
                            'type'  => 'text',
                            'title' => 'Cpt Info',
                        ),

                    ),
                ),
            ),

        );
    }

    return $options;
}

add_filter( 'cs_metabox_options', 'philosophy_custom_post' );

function philosophy_meta_upload( $options ) {

    $options[] = array(
        'id'        => 'page-metabox2',
        'title'     => 'Page Upload Files',
        'icon'      => 'fa fa-heart',
        'post_type' => 'page',
        'context'   => 'normal',
        'priority'  => 'default',
        'sections'  => array(
            array(
                'name'   => 'page-section2',
                'type'   => 'text',
                //'title' => 'Page Settings',
                'icon'   => 'fa fa-image',
                'fields' => array(
                    array(
                        'id'       => 'file_upload',
                        'type'     => 'upload',
                        'title'    => 'Upload PDF',
                        'settings' => array(
                            'upload_type'  => 'application/pdf',
                            'button_title' => 'Upload PDF',

                        ),
                    ),
                    array(
                        'id'       => 'image_upload',
                        'type'     => 'image',
                        'title'    => 'Upload Image',
                        'settings' => array(
                            'upload_type'  => 'image',
                            'button_title' => 'Upload',
                            'frame_title'  => 'Select an image',
                            'insert_title' => 'Use this image',
                        ),
                    ),
                    array(
                        'id'          => 'gallery_upload',
                        'type'        => 'gallery',
                        'title'       => 'Upload Gallery',
                        'edit_title'  => 'Edit Images',
                        'clear_title' => 'Remove Images',
                    ),
                    array(
                        'id'     => 'fieldset_1',
                        'type'   => 'fieldset',
                        'title'  => 'Fieldset Field',
                        'fields' => array(

                            array(
                                'id'    => 'fieldset_1_text',
                                'type'  => 'text',
                                'title' => 'Text Field',
                            ),

                            array(
                                'id'    => 'fieldset_1_upload',
                                'type'  => 'upload',
                                'title' => 'Upload Field',
                            ),

                            array(
                                'id'    => 'fieldset_1_textarea',
                                'type'  => 'textarea',
                                'title' => 'Textarea Field',
                            ),

                        ),

                    ),
                    array(
                        'id'              => 'repeatar',
                        'type'            => 'group',
                        'title'           => 'Group Field',
                        'button_title'    => 'Add New',
                        'accordion_title' => 'Add New Field',
                        'fields'          => array(
                            array(
                                'id'    => 'text1',
                                'type'  => 'text',
                                'title' => 'Text Field 100',
                            ),
                            array(
                                'id'    => 'file',
                                'type'  => 'upload',
                                'title' => 'Upload Field',
                            ),
                            array(
                                'id'    => 'switch',
                                'type'  => 'switcher',
                                'title' => 'Switcher Field',
                            ),
                        ),
                    ),

                ),
            ),
        ),
    );
    return $options;
}

add_filter( 'cs_metabox_options', 'philosophy_meta_upload' );

function philosophy_cs_google_map( $options ) {
    $options[] = array(
        'name'       => 'group_1',
        'title'      => 'Group #1',
        'shortcodes' => array(

            array(
                'name'   => 'gmap',
                'title'  => 'Google Map',
                'fields' => array(
                    array(
                        'id'      => 'place',
                        'type'    => 'text',
                        'title'   => 'Place',
                        'help'    => 'Enter Place',
                        'default' => 'Notre Dame College, Dhaka',
                    ),
                    array(
                        'id'      => 'width',
                        'type'    => 'text',
                        'title'   => 'Width',
                        'default' => '100%',
                    ),
                    array(
                        'id'      => 'height',
                        'type'    => 'text',
                        'title'   => 'Height',
                        'default' => 500,
                    ),
                    array(
                        'id'      => 'zoom',
                        'type'    => 'text',
                        'title'   => 'Zoom',
                        'default' => 14,
                    ),
                ),
            ),

        ),
    );

    return $options;
}

add_filter( 'cs_shortcode_options', 'philosophy_cs_google_map' );

function philosophy_custom_taxonomy_field_add( $options ) {
    $options[] = array(
        'id'       => 'custom_category_options',
        'taxonomy' => 'language', // or array( 'category', 'post_tag' )

        'fields' => array(

            array(
                'id'    => 'featured_image',
                'type'  => 'image',
                'title' => 'Featured Image',
            ),

        ),
    );
    return $options;
}

add_filter( 'cs_taxonomy_options', 'philosophy_custom_taxonomy_field_add' );

function philosophy_theme_option_init(){
    $settings = array(
        'menu_title'=>__('Framework','philosophy'),
       //'menu_type'=>'submenu',
        //'menu_parent'=>'themes.php',
        'menu_slug'=>'philosophy_option_panel',
        'framework_title'=>__('Philosophy Options','philosophy'),
        'menu_icon'=>'dashicons-dashboard',
        'menu_position'=>20,
        'ajax_save'=>false,
        'show_reset_all'=>true
    );

    $options = philosophy_theme_options();
    new CSFramework($settings,$options);
}
add_action("init","philosophy_theme_option_init");

function philosophy_theme_options(){
    $options = array();
    $options[] = array(
        'name'=>'footer_options',
        'title'=>__('Footer Options','philosophy'),
        'icon'=>'fa fa-edit',
        'fields'=>array(
            array(
                'id'=>'footer_tag',
                'type'=>'switcher',
                'title'=>__('Tags Area Visible?','philosophy'),
                'default'=>'0'
            ),
            array(
                'id'    => 'social_facebook',
                'type'  => 'text',
                'title' => __('Facebook URL','philosophy')
            ),array(
                'id'    => 'social_twitter',
                'type'  => 'text',
                'title' => __('Twitter URL','philosophy')
            ),array(
                'id'    => 'social_pinterest',
                'type'  => 'text',
                'title' => __('Pinterest URL','philosophy')
            ),
        )
    );

    $options[] = array(
        'name'   => 'section_1',
        'title'  => 'Section 1',
        'icon'   => 'fa fa-wifi',
        'fields' => array(

            // a field
            array(
                'id'    => 'metabox_option_id',
                'type'  => 'text',
                'title' => 'An Text Option',
            ),

            // a field
            array(
                'id'    => 'metabox_option_other_id',
                'type'  => 'textarea',
                'title' => 'An Textarea Option',
            ),

        ),
    );

    // begin section


    // begin section
    $options[] = array(
        'name'   => 'section_2',
        'title'  => 'Section 2',
        'icon'   => 'fa fa-heart',
        'fields' => array(

            // a field
            array(
                'id'    => 'metabox_option_2_id',
                'type'  => 'text',
                'title' => 'An Text Option',
            ),

        ),


    );

    return $options;
}