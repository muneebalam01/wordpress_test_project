<?php
/**
 * wordpress_test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wordpress_test
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
function wordpress_test_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on wordpress_test, use a find and replace
		* to change 'wordpress_test' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'wordpress_test', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'wordpress_test' ),
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
			'wordpress_test_custom_background_args',
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
add_action( 'after_setup_theme', 'wordpress_test_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wordpress_test_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wordpress_test_content_width', 640 );
}
add_action( 'after_setup_theme', 'wordpress_test_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wordpress_test_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'wordpress_test' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'wordpress_test' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wordpress_test_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wordpress_test_scripts() {
	wp_enqueue_style( 'wordpress_test-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'wordpress_test-style', 'rtl', 'replace' );

	wp_enqueue_script( 'wordpress_test-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wordpress_test_scripts' );


function my_enqueue_ajax_script() {
	wp_enqueue_script('wordpress_test_jquery' , 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js');
	wp_enqueue_script( 'my-ajax-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );
   
	// Localize the script with new data
 $ajax_url = admin_url( 'admin-ajax.php' );
  wp_localize_script( 'my-ajax-script', 'ajax_object', array( 'ajax_url' => $ajax_url ) );
  }
   
  add_action( 'wp_enqueue_scripts', 'my_enqueue_ajax_script' );
  




/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/project-cpt.php';
require get_template_directory() . '/inc/project-taxonmy.php';

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




 // user ip starts with 77.29	
function redirect_if_ip_starts_with_7729() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $ip_prefix = '77.29';
	echo "User IP :" . $user_ip ;
    if (strpos($user_ip, $ip_prefix) === 0) {
        // IP address starts with 77.29, redirect the user
        header('Location: http://localhost/wordpress_test_project/you-are-not-allowed/');
        exit;
    }
}

add_shortcode('my_ip_7729' , 'redirect_if_ip_starts_with_7729');




/** 
 * Posts per page for CPT archive
 * prevent 404 if posts per page on main query
 * is greater than the posts per page for product cpt archive
 *
 * thanks to https://sridharkatakam.com/ for improved solution!
 */

 function prefix_change_cpt_archive_per_page( $query ) {
    
    //* for cpt or any post type main archive
    if ( $query->is_main_query() && ! is_admin() && is_post_type_archive( 'project' ) ) {
        $query->set( 'posts_per_page', '2' );
    }

}
add_action( 'pre_get_posts', 'prefix_change_cpt_archive_per_page' );

/**
 * 
 * Posts per page for category (test-category) under CPT archive 
 *
*/
function prefix_change_category_cpt_posts_per_page( $query ) {

    if ( $query->is_main_query() && ! is_admin() && is_category( 'test-category' ) ) {
        $query->set( 'post_type', array( 'project' ) );
        $query->set( 'posts_per_page', '2' );
    }

}
add_action( 'pre_get_posts', 'prefix_change_category_cpt_posts_per_page' );


/**
*
* custom numbered pagination 
* @http://callmenick.com/post/custom-wordpress-loop-with-pagination
* 
*/
function custom_pagination( $numpages = '', $pagerange = '', $paged='' ) {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default queries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}

if ( ! is_user_logged_in() ) { 
add_action( 'wp_ajax_my_ajax_endpoint', 'my_ajax_function' );
add_action( 'wp_ajax_nopriv_my_ajax_endpoint', 'my_ajax_function' );

function my_ajax_function() {
    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
		'tax_query'     => array(
			array(
			  'taxonomy' => 'projecttype', 
			  'field' => 'slug',
			  'terms' => array( 
				'architecture',  
			  )
			)
		  )	
);
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) { ?>
		<div class = "all_new_projects_row">
		<?php  while ( $query->have_posts() ) { ?>
		<div class = "inner_prjoect">
        <?php  $query->the_post();?>
			<h3><?php the_title(); ?> </h3>
		<?php the_content();  ?>
		 </div>
			<?php } ?> 
		</div>
		<?php wp_reset_postdata();  }
     else {
    }
    wp_die();
}
}
else {



	add_action( 'wp_ajax_my_ajax_endpoint_loggedin', 'my_ajax_function_loggedin' );
	add_action( 'wp_ajax_nopriv_my_ajax_endpoint_loggedin', 'my_ajax_function_loggedin' );
	
	function my_ajax_function_loggedin() {
		$args = array(
			'post_type'      => 'project',
			'posts_per_page' => 6,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'tax_query'     => array(
				array(
				  'taxonomy' => 'projecttype', 
				  'field' => 'slug',
				  'terms' => array( 
					'architecture',  
				  )
				)
			  )	
	);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) { ?>
			<div class = "all_new_projects_row">
			<?php  while ( $query->have_posts() ) { ?>
			<div class = "inner_prjoect">
			<?php  $query->the_post();?>
				<h3><?php the_title(); ?> </h3>
			<?php the_content();  ?>
			 </div>
				<?php } ?> 
			</div>
			<?php wp_reset_postdata();  }
		 else {
		}
		wp_die();
	}



}