<?php
function theme_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',  array( $parent_style ) );

    /**conditional register stylesheet */
    wp_register_style( 'landing_page', get_stylesheet_directory_uri() . '/LP/style_landing.css' );
    //if ( is_page( 'home' ) ) {
        wp_enqueue_style( 'landing_page' );
   // }
  
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/* Side Register Function*/
add_action( 'widgets_init', 'lucere_page_widgets_init' );
function lucere_page_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Page Sidebar', 'divi-child' ),
        'id' => 'sidebar-lucere-11',
        'description' => __( 'Widgets in this area will be shown on template sidebar-custom pages.', 'divi-child' ),
        'before_widget' => '<div id="%1$s" class="et_pb_widget %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h4 class="widgettitle">',
	'after_title'   => '</h4>',
    ) );
}

//* Do NOT include the opening php tag
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


/***Mobile Accordion Menu  **/
function et_add_mobile_accordion_navigation(){
	if ( is_customize_preview() || ( 'slide' !== et_get_option( 'header_style', 'left' ) && 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) ) {
		printf(
			'<div id="et_mobile_nav_menu">
				<div class="mobile_nav closed">
					<span class="select_page">%1$s</span>
					<span class="mobile_menu_bar mobile_menu_bar_toggle"></span>
					<ul id="mobile_menu" class="et_mobile_menu" >'.do_shortcode('[accordionmenu id="unique6a1a684" accordionmenu="6478"]').'</ul>
				</div>				
			</div>',
			esc_html__( 'Select Page', 'Divi' )
		);
  
	}
}
add_action( 'et_header_top_accordion', 'et_add_mobile_accordion_navigation' );


/**********************
*Shortcode for treatment and condiotion pages
*********************/
function custom_page_links_shortcode($atts , $content) {

    $atts  = shortcode_atts(
                 array(
                       'name' => 'Uncategorized',
                       'content' => !empty($content) ? $content : 'N/A'
                 ), $atts
                );
                extract($atts);


        $catquery = new WP_Query( array( 
                    'category_name' => $name,
                    'posts_per_page' => 30,  
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                 ) );
     //$catquery = new WP_Query( 'cat='.$id.'&posts_per_page=30' );
     $daa .= '<section class="content inner-pages">
     <div class="our-serivce">
       <div class="container contw">
         <div class="row" style="margin:auto;">';    
     while($catquery->have_posts()) : $catquery->the_post();
        $daa .='<div class="col-sm-3 col-xs-12 full-width">
    <div class="service-box"> <a href="'.get_the_permalink().'">'.get_the_post_thumbnail().'
      <h4>'.str_replace(array('Treatment', 'Edmonton','Correction','Removal'), array('','','',''), get_the_title()).'</h4> </a>
      <div style="width:100%;" class="service-box-detail">
        <h4><a href="'.get_the_permalink().'" style="background:none; padding-left:0px; font-size:22px;">'.str_replace(array('Treatment', 'Edmonton','Correction','Removal'), array('','','',''), get_the_title()).'</a></h4>
        <p>'.get_the_excerpt().'</p>
      </div>
    </div>
  </div> ';
     endwhile; 
     wp_reset_postdata(); 
     $daa .= ' </div>
     </div>
   </div>
   </section>';	

    return $daa;
}
add_shortcode('custom_post_links', 'custom_page_links_shortcode');

/***Remove Book an appointment button */

function remove_book_appointment(){
    if(is_page('book-an-appointment')){
            echo '<style type="text/css">    .btn-book-app{ display: none !important;}        </style>';
    }
}

add_action( 'wp_head', 'remove_book_appointment' );

?>