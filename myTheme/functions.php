<?php 
add_action( 'wp_enqueue_scripts', 'add_styles' );
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
add_action('after_setup_theme', 'theme_add_navs');
add_action( 'wp_footer', 'add_scripts' );
add_action( 'widgets_init', 'register_my_widgets' );

function my_scripts_method(){
	wp_enqueue_script( 'jquery' );
}
function add_styles(){
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style( 'default', get_template_directory_uri().'/assets/css/default.css');
	wp_enqueue_style( 'fonts', get_template_directory_uri().'/assets/css/fonts.css');
	wp_enqueue_style( 'layout', get_template_directory_uri().'/assets/css/layout.css');
	wp_enqueue_style( 'media-queries', get_template_directory_uri().'/assets/css/media-queries.css');
}
function theme_add_navs(){
	register_nav_menu('главное', 'Верхнее меню1');
	register_nav_menu('footer', 'Меню подвала');
	add_theme_support('title-tag');
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	add_image_size( 'post_thumb', 1300, 500, true);
}
function add_scripts(){
	wp_enqueue_script('init', get_template_directory_uri().'/assets/js/init.js');
	wp_enqueue_script('doubletaptogo', get_template_directory_uri().'/assets/js/doubletaptogo.js');
	wp_enqueue_script('modernizr', get_template_directory_uri().'/assets/js/modernizr.js');
	wp_enqueue_script('jquery.flexslider', get_template_directory_uri().'/assets/js/jquery.flexslider.js');
	wp_enqueue_script('jquery-migrate-1.2.1.min', get_template_directory_uri().'/assets/js/jquery-migrate-1.2.1.min.js');
	}
function register_my_widgets(){
	register_sidebar( array(
		'name'          => 'Right sidebar',
		'id'            => 'left-sidebar',
		'description'   => 'my descriptions',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
	) );
	register_sidebar( array(
		'name'          => 'Bottom sidebar',
		'id'            => 'bottom-sidebar',
		'description'   => 'Нижний сайдбар',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
	) );
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	global $post;
	return ' ';
}
add_filter( 'excerpt_length', function(){
	return 25;
} );
// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
	/*
	Вид базового шаблона:
	<nav class="navigation %1$s" role="navigation">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="nav-links">%3$s</div>
	</nav>
	*/

	return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// выводим пагинацию
the_posts_pagination( array(
	'end_size' => 2,
) ); 
 ?>