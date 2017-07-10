<?php
/**
 * Speculate functions and definitions
 * @package Speculate
 */


/**
 * Loads the child theme textdomain.
 */
function speculate_child_theme_setup() {
    load_child_theme_textdomain( 'speculate', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'speculate_child_theme_setup' ); 
 
/**
 * Enqueue scripts and styles.
 * Load parent stylesheet
 */
function speculate_enqueue_styles() {
	wp_enqueue_style( 'speculate-twentyfifteen-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'speculate_enqueue_styles' );


/**
 * Register Google fonts for Speculate by overrideing the parent theme
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
function twentyfifteen_fonts_url() { // cancel out and override the twentyfifteen fonts url
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'speculate' ) ) {
		$fonts[] = 'Open Sans:400,600,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

endif;

// Move the More Link outside from the contents last summary paragraph tag.
if ( ! function_exists( 'speculate_move_more_link' ) ) :
	function speculate_move_more_link($link) {
			$link = '<p class="more-link-wrapper">'.$link.'</p>';
			return $link;
		}
	add_filter('the_content_more_link', 'speculate_move_more_link');
endif;


/**
 * Add more colour schemes to the Twenty Fifteen theme
 * @since Speculate 1.0.0
 */
add_filter('twentyfifteen_color_schemes', 'speculate_my_custom_color_schemes');
function speculate_my_custom_color_schemes( $schemes ) {
    $schemes['taupe'] = array(
        'label'  => __( 'Taupe', 'speculate' ),
        'colors' => array(
            '#f7f4f0',
            '#6d6356',
            '#ffffff',
            '#333333',
            '#fbf5f0',
            '#f7f7f7',
        ),
    );
    return $schemes;
}

/**
 * Re-Register widget area from parent theme so it remains as the first
 * sidebar in the Widgets admin area. Then we add our new sidebar(s)
 * @since Speculate 1.0.0
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function speculate_sidebars( ) {
	
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'speculate' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'speculate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Banner', 'speculate' ),
		'id'            => 'banner',
		'description'   => __( 'A special banner sidebar for loading images or sliders.', 'speculate' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
}
add_action( 'widgets_init', 'speculate_sidebars' );


/**
 * Theme Customizer.
 * @package Speculate
 */
function speculate_customize_register( $wp_customize ) {
	
// social icon background-color
 	$wp_customize->add_setting( 'speculate_social_bg', array(
		'default'        => '#ececec',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'speculate_social_bg', array(
		'label'   => __( 'Social Icon Background', 'speculate' ),
		'section' => 'colors',
		'settings'   => 'speculate_social_bg',
	) ) );	
// read more link
 	$wp_customize->add_setting( 'speculate_morelink', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'speculate_morelink', array(
		'label'   => __( 'Continue Reading Colour', 'speculate' ),
		'section' => 'colors',
		'settings'   => 'speculate_morelink',
	) ) );		
// blog pagination background-color
 	$wp_customize->add_setting( 'speculate_blog_nav', array(
		'default'        => '#f7f7f7',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'speculate_blog_nav', array(
		'label'   => __( 'Blog Pagination Background Button Colour', 'speculate' ),
		'section' => 'colors',
		'settings'   => 'speculate_blog_nav',
	) ) );	
}
add_action( 'customize_register', 'speculate_customize_register' );	



// Custom Inline styles
function speculate_inline_styles($custom) {

	$speculate_social_bg = get_theme_mod( 'speculate_social_bg', '#ececec' );
	$speculate_morelink = get_theme_mod( 'speculate_morelink', '#333' );
	$speculate_blog_nav = get_theme_mod( 'speculate_blog_nav', '#f7f7f7' );
	$custom .= ".entry-content a.more-link, .entry-summary a.more-link {color: " . esc_attr($speculate_morelink) . "; }
	.pagination .prev, .pagination .next {background-color: " . esc_attr($speculate_blog_nav) . "; }
	.social-navigation a:before { background-color: " . esc_attr($speculate_social_bg) . "; }"."\n";
		
//Output all the styles
	wp_add_inline_style( 'speculate-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'speculate_inline_styles' );		