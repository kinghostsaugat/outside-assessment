<?php

if (!defined('outside')) {
	// Replace the version number of the theme on each release.
	define('outside', '1.0.0');
}

function _s_setup()
{

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'outside'),
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
}
add_action('after_setup_theme', '_s_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'outside'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'outside'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', '_s_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function outside_scripts()
{
	wp_enqueue_style('outside-style', get_stylesheet_uri(), array(), outside);
	wp_enqueue_style('swiper-css', get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.css', array(), '9.3.1');
	wp_enqueue_style('outside-styles', get_template_directory_uri() . '/dist/style.css');

	wp_enqueue_script('vimeo-player', get_template_directory_uri() . '/node_modules/@vimeo/player/dist/player.min.js', array(), '1.0', true);
	wp_enqueue_script('swiper-js', get_template_directory_uri() . '/node_modules/swiper/swiper-bundle.min.js', array(), '9.3.1', true);
	wp_enqueue_script('outsite-main', get_template_directory_uri() . '/js/main.js', array(), outside, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'outside_scripts');

// if (function_exists('acf_register_block_type')) {
// 	add_action('acf/init', 'register_acf_block_types');
// }
// function register_acf_block_types()
// {
// 	acf_register_block_type(array(
// 	"name" => "sliders",
//     "title" => "Slider with accordians",
//     "description" => "A custom testimonial block that uses ACF fields.",
// 	'render_template' => 'index.php',
//     "category" => "formatting",
//     "icon" => "editor-paste-text",
//     "keywords" => ["sliders", "accordian"],
// 	));
// }

function tt3child_register_acf_blocks() {

    register_block_type( __DIR__ . '/blocks/sliders-with-accordian' );
}
add_action( 'init', 'tt3child_register_acf_blocks' );
