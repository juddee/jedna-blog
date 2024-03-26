<?php
/**
 * Jedna Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jedna_Blog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function jedna_blog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Jedna Blog, use a find and replace
		* to change 'jedna-blog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'jedna-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary', 'jedna-blog' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'jedna_blog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'jedna_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jedna_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'jedna_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'jedna_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function jedna_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'jedna-blog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'jedna-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'jedna_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function jedna_blog_scripts() {
	wp_enqueue_style( 'jedna-blog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'jedna-blog-style', 'rtl', 'replace' );

	// theme styles & resources
	wp_enqueue_style('jedna-blog-bootstrap-style' , get_template_directory_uri().'/public/bootstrap/dist/css/bootstrap.min.css');
	wp_enqueue_style('jedna-blog-fontawesome' , get_template_directory_uri().'/public/fontawesome/css/all.css');

	wp_enqueue_style('jedna-blog-single-style' , get_template_directory_uri().'/public/css/single.css');

	wp_enqueue_script( 'jedna-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// theme scripts
	wp_enqueue_script('jedna-blog-bootstrap-script', get_template_directory_uri().'/public/bootstrap/dist/js/bootstrap.bundle.min.js');
	wp_enqueue_script('jedna-blog-main-script', get_template_directory_uri().'/public//js/main.js');
	
}
add_action( 'wp_enqueue_scripts', 'jedna_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}





/**
 * Enable woocommerce support
 */

 add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() 
{
   	add_theme_support( 'woocommerce' );
} 



/**
 * 
 * 
 */


	add_action('customize_register', 'theme_customizer_settings');

	function theme_customizer_settings($wp_customize) {
		// Section for Featured Post
		$wp_customize->add_section('featured_post_section', array(
			'title' => __('Featured Post', 'text-domain'),
			'priority' => 30,
		));

		// Control for selecting featured post
		$wp_customize->add_setting('featured_post', array(
			'default' => 0, // Default to no post selected
			'sanitize_callback' => 'absint',
		));

		$wp_customize->add_control('featured_post_control', array(
			'label' => __('Select Featured Post', 'text-domain'),
			'section' => 'featured_post_section',
			'settings' => 'featured_post',
			'type' => 'select', // Use 'select' type for dropdown
			'choices' => get_dropdown_post_choices(), // Function to generate post choices
		));
		
		
		// Control for selecting recent posts
		$wp_customize->add_setting('recent_posts', array(
			'default' => 0, // Default to no posts selected
			'sanitize_callback' => 'sanitize_text_field', // Sanitize as text field
		));


		$wp_customize->add_control('recent_posts_control', array(
			'label' => __('Enter 4  Posts IDs (comma-separated).', 'text-domain'),
			'section' => 'featured_post_section',
			'settings' => 'recent_posts',
			'type' => 'text',
		));
		/* */

		// Section for Specific Category Posts
		$wp_customize->add_section('specific_category_section', array(
			'title' => __('Featured Category', 'text-domain'),
			'priority' => 30,
		));

		// Control for selecting specific category
		$wp_customize->add_setting('specific_category', array(
			'default' => 0, // Default to no category selected
			'sanitize_callback' => 'absint',
		));

		$wp_customize->add_control('specific_category_control', array(
			'label' => __('Enter specific category ID you want to be featured on the home page', 'text-domain'),
			'section' => 'specific_category_section',
			'settings' => 'specific_category',
			'type' => 'dropdown-categories', // Dropdown to select a category
		));

		// Control for selecting to show or hide specific category
		$wp_customize->add_setting('show_specific_category', array(
				'default' => 1, // Default to no category selected
				'sanitize_callback' => 'absint',
		));

		$wp_customize->add_control('show_specific_category', array(
			'label' => __('Show feature Category', 'text-domain'),
			'section' => 'specific_category_section',
			'settings' => 'show_specific_category',
			'type' => 'checkbox', // checkbox to hide or display this section
		));

		// 
		// Add section for social media links
		$wp_customize->add_section('footer_social_media_section', array(
			'title' => __('Footer Social Media Links', 'custom-theme'),
			'priority' => 30,
		));

		// Add setting for social media links
		$wp_customize->add_setting('footer_social_media_links', array(
			'default' => '[
				{ "icon-class": "fa-brands fa-facebook", "url": "https://facebook.com/profileid" },
				{ "icon-class": "fa-brands fa-twitter", "url": "https://twitter.com/profileid" }
			]', // Default to an empty array
			'sanitize_callback' => 'sanitize_text_field',
		));


		// Add control for social media links
		$wp_customize->add_control('footer_social_media_links', array(
			'label' => __('Social Media Links', 'custom-theme'),
			'description' => __('Enter social media links in the format: 
				[
					{ "icon-class": "fa-brands fa-facebook", "url": "https://facebook.com/profileid" }, 
					{ "icon-class": "fa-brands fa-twitter", "url": "https://twitter.com/profileid" }
				]', 'custom-theme'),
			'section' => 'footer_social_media_section',
			'type' => 'textarea',
		));

		
	}


	// Function to create a page with a specific template
	function create_custom_page_with_template() {
		// Check if the page exists by title
		$page = get_page_by_title('Blog');

		// If the page doesn't exist, create it
		if (empty($page)) {
			$page_args = array(
				'post_title'    => 'Blog',
				'post_content'  => '', // You can set content here if needed
				'post_status'   => 'publish',
				'post_type'     => 'page',
				'page_template' => 'blog-template.php' // Specify your template file
			);

			// Insert the page
			$page_id = wp_insert_post($page_args);

			// Optionally, you can add meta data, taxonomies, or other customizations here

			// Update page cache
			wp_cache_delete($page_id, 'posts');
		}else{

			update_post_meta($page->ID, '_wp_page_template', 'blog-template.php');

		}
	}
	add_action('after_setup_theme', 'create_custom_page_with_template');


	// Function to generate choices for dropdown
	function get_dropdown_post_choices() {
		$posts = get_posts(array(
			'post_type' => 'post', // Adjust post type as needed
			'numberposts' => -1,
		));
		
		$choices = array();
		
		foreach ($posts as $post) {
			$choices[$post->ID] = $post->post_title;
		}
		
		return $choices;
	}



	// Add custom class and id to the comment form container
	add_action('comment_form_before', 'add_custom_class_and_id_before_comment_form');
	add_action('comment_form_after', 'add_custom_class_and_id_after_comment_form');

	function add_custom_class_and_id_before_comment_form() {
		echo '<div class="comment-respond collapse py-3" id="commentForm">';
	}

	function add_custom_class_and_id_after_comment_form() {
		echo '</div>';
	}

