<?php
/**
 * ikonic test functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ikonic_test
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
function ikonic_test_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on ikonic test, use a find and replace
		* to change 'ikonic-test' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'ikonic-test', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'ikonic-test' ),
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
			'ikonic_test_custom_background_args',
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
add_action( 'after_setup_theme', 'ikonic_test_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ikonic_test_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ikonic_test_content_width', 640 );
}
add_action( 'after_setup_theme', 'ikonic_test_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ikonic_test_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'ikonic-test' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'ikonic-test' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ikonic_test_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ikonic_test_scripts() {
	wp_enqueue_style( 'ikonic-test-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'ikonic-test-style', 'rtl', 'replace' );

	wp_enqueue_script( 'ikonic-test-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ikonic_test_scripts' );

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

function redirect_user_based_on_ip() {
    // Get the user's IP address
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // Check if the IP address starts with 77.29
    if (strpos($user_ip, '77.29') === 0) {
        // Redirect the user to a different website or page
        wp_redirect('https://rahmanzeb.com'); // Replace with your desired URL
        exit; // Stop further execution
    }
}
add_action('wp', 'redirect_user_based_on_ip');


// Register custom post type
function register_projects_post_type() {
	$labels = array(
			'name'                  => 'Projects',
			'singular_name'         => 'Project',
			'menu_name'             => 'Projects',
			'add_new'               => 'Add New',
			'add_new_item'          => 'Add New Project',
			'edit'                  => 'Edit',
			'edit_item'             => 'Edit Project',
			'new_item'              => 'New Project',
			'view'                  => 'View',
			'view_item'             => 'View Project',
			'search_items'          => 'Search Projects',
			'not_found'             => 'No projects found',
			'not_found_in_trash'    => 'No projects found in trash',
			'parent'                => 'Parent Project'
	);

	$args = array(
			'labels'                => $labels,
			'public'                => true,
			'has_archive'           => true,
			'publicly_queryable'    => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => 'projects'),
			'capability_type'       => 'post',
			'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
			'taxonomies'            => array('project_type'),
			'menu_position'         => 5,
			'menu_icon'             => 'dashicons-portfolio'
	);

	register_post_type('projects', $args);
}
add_action('init', 'register_projects_post_type');

// Register custom taxonomy
function register_project_type_taxonomy() {
	$labels = array(
			'name'                       => 'Project Types',
			'singular_name'              => 'Project Type',
			'search_items'               => 'Search Project Types',
			'all_items'                  => 'All Project Types',
			'parent_item'                => 'Parent Project Type',
			'parent_item_colon'          => 'Parent Project Type:',
			'edit_item'                  => 'Edit Project Type',
			'update_item'                => 'Update Project Type',
			'add_new_item'               => 'Add New Project Type',
			'new_item_name'              => 'New Project Type Name',
			'menu_name'                  => 'Project Type',
	);

	$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'query_var'             => true,
			'rewrite'               => array('slug' => 'project-type')
	);

	register_taxonomy('project_type', 'projects', $args);
}
add_action('init', 'register_project_type_taxonomy');



// Enqueue the custom API script
function enqueue_custom_scripts() {
	// Enqueue the wp-api.js script
	wp_enqueue_script('wp-api');

	// Localize the script to pass data to JavaScript
	wp_localize_script('wp-api', 'customApiSettings', array(
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'nonce'   => wp_create_nonce('custom-api-nonce'),
	));

	// Enqueue the custom API script
	wp_enqueue_script('custom-api', get_template_directory_uri() . '/js/custom-api.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// Register the API endpoint
function register_projects_api_endpoint() {
	register_rest_route('mytheme/v1', '/projects', array(
			'methods'             => 'GET',
			'callback'            => 'get_projects_api_data',
			'permission_callback' => function () {
					return true; // Allow access to all users
			},
	));
}
add_action('rest_api_init', 'register_projects_api_endpoint');

// Handle the API request
function get_projects_api_data($request) {
	$response = array();

// Check if the user is logged in
$is_user_logged_in = false;

// Define the cookie name
$cookie_name = '';

// Get all cookies
$cookies = $_COOKIE;

// Loop through the cookies to find the authentication cookie
foreach ($cookies as $name => $value) {
    if (strpos($name, 'wordpress_logged_in_') === 0) {
        $cookie_name = $name;
				$response['cookies'] = $name;
        break;
    }
}

// Check if the authentication cookie was found
if (!empty($cookie_name)) {
  $is_user_logged_in = true;
}


// Rest of the code...


	// Query arguments
	$args = array(
			'post_type'      => 'projects',
			'posts_per_page' => $is_user_logged_in ? 6 : 3,
			'tax_query'      => array(
					array(
							'taxonomy' => 'project_type',
							'field'    => 'slug',
							'terms'    => 'architecture',
					),
			),
	);

	// Perform the query
	$query = new WP_Query($args);

	// Process the query results
	if ($query->have_posts()) {
			$projects = array();
			while ($query->have_posts()) {
					$query->the_post();
					$project = array(
							'id'    => get_the_ID(),
							'title' => get_the_title(),
							'link'  => get_permalink(),
					);
					$projects[] = $project;
			}
			$response['success'] = true;
			$response['data'] = $projects;
	} else {
			$response['success'] = false;
			$response['message'] = __('No projects found.');
	}

	// Reset the global post data
	wp_reset_postdata();

	// Return the API response
	return $response;
}







//function for getting random coffee link
function hs_give_me_coffee() {
	// API endpoint URL
	$api_url = 'https://coffee.alexflipnote.dev/random.json';

	// Send a GET request to the API endpoint
	$response = wp_remote_get($api_url);

	// Check if the request was successful
	if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
			// Error handling, if needed
			return 'Unable to fetch coffee. Please try again later.';
	}

	// Get the response body (JSON data)
	$data = wp_remote_retrieve_body($response);

	// Parse the JSON data
	$coffee_data = json_decode($data);

	// Check if the JSON data was successfully parsed and contains the "file" property
	if (!$coffee_data || empty($coffee_data->file)) {
			return 'Unable to fetch coffee. Please try again later.';
	}

	// Return the direct link to the coffee image
	return $coffee_data->file;
}


//function for display random 5 quotes form kanye west api
function get_kanye_quotes($count = 5) {
	// API endpoint URL
	$api_url = 'https://api.kanye.rest/';

	// Initialize an empty array to store the quotes
	$quotes = array();

	// Fetch quotes from the API
	for ($i = 0; $i < $count; $i++) {
			// Send a GET request to the API endpoint
			$response = wp_remote_get($api_url);

			// Check if the request was successful
			if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
					// Error handling, if needed
					return array();
			}

			// Get the response body (JSON data)
			$data = wp_remote_retrieve_body($response);

			// Parse the JSON data
			$quote_data = json_decode($data);

			// Check if the JSON data was successfully parsed and contains the "quote" property
			if ($quote_data && isset($quote_data->quote)) {
					// Add the quote to the quotes array
					$quotes[] = $quote_data->quote;
			}
	}

	// Return the array of quotes
	return $quotes;
}
