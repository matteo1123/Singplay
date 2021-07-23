<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

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
	 * Enables custom line height for blocks
	 */
	add_theme_support( 'custom-line-height' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'twentyseventeen' ),
			'social' => __( 'Social Links Menu', 'twentyseventeen' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://wordpress.org/support/article/post-formats/
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 250,
			'height'     => 250,
			'flex-width' => true,
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
	  */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'     => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/sandwich.jpg',
			),
			'image-coffee'   => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file'       => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods'  => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name'  => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filters Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'fallback' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'twentyseventeen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 1', 'twentyseventeen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer 2', 'twentyseventeen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Post title. */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );

	$customize_preview_data_hue = '';
	if ( is_customize_preview() ) {
		$customize_preview_data_hue = 'data-hue="' . $hue . '"';
	}
	?>
	<style type="text/css" id="custom-theme-colors" <?php echo $customize_preview_data_hue; ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueues scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );
	wp_enqueue_style( 'bs_css', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri(), array(), '20201208' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentyseventeen-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'twentyseventeen-style' ), '20190105' );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '20190408' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '20161202' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '20161202' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '20161020' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '20161114', true );

	$twentyseventeen_l10n = array(
		'quote' => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '20161203', true );
		$twentyseventeen_l10n['expand']   = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse'] = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']     = twentyseventeen_get_svg(
			array(
				'icon'     => 'angle-down',
				'fallback' => true,
			)
		);
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '20190121', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Enqueues styles for the block-based editor.
 *
 * @since Twenty Seventeen 1.8
 */
function twentyseventeen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentyseventeen-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ), array(), '20201208' );
	// Add custom fonts.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentyseventeen_block_editor_styles' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			$sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filters the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 * @return string The template to be used: blank if is_home() is true (defaults to index.php),
 *                otherwise $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'twentyseventeen_front_page_template' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Seventeen 1.4
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentyseventeen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentyseventeen_widget_tag_cloud_args' );

/**
 * Gets unique ID.
 *
 * This is a PHP implementation of Underscore's uniqueId method. A static variable
 * contains an integer that is incremented with each call. This number is returned
 * with the optional prefix. As such the returned value is not universally unique,
 * but it is unique across the life of the PHP process.
 *
 * @since Twenty Seventeen 2.0
 *
 * @see wp_unique_id() Themes requiring WordPress 5.0.3 and greater should use this instead.
 *
 * @param string $prefix Prefix for the returned ID.
 * @return string Unique ID.
 */
function twentyseventeen_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';


/////////////////////////////////// Edits made by matt@hirematt.dev /////////////////////////////////////////////
//  function wd_admin_menu_remove() {
// 	remove_menu_page( 'link-manager.php' );
// 	remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
// }
// add_action( 'admin_menu', 'wd_admin_menu_remove' );

// One column dashboard
function single_column( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_column' );

function one_column_dashboard(){
	return 1;
}
add_filter( 'get_user_option_screen_layout_dashboard', 'one_column_dashboard' );
// Create custom WordPress admin dashboard items

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'DASHBOARD', 'custom_dashboard_help');
}
function custom_dashboard_help() {
	// ROW WITH HEADING
	echo '
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<div>
	<h2>Quick Links</h2>
	<hr>
	</div>';

// COLUMNS WITH SHORTCUTS
	echo '<div class="row" style="width:80vw; display:flex; justify-content:space-around;">
  	<div class="col-md-2 col-12"><a title="Pages make up the back bone of the site"  href="/wp-admin/edit.php?post_type=page" class="btn col-12 btn-lg btn-dark">Pages</a></div>
	<div class="col-md-2"><a href="/wp-admin/edit.php" title="Posts are open to the public free to everyone content that you can easily generate" class="btn col-12 btn-lg btn-dark">Posts</a></div>
	<div class="col-md-2"><a href="/wp-admin/edit.php?post_type=courses" title="One course consists of many classes" class="btn col-12 btn-lg btn-dark">Courses</a></div>
	<div class="col-md-2"><a href="/wp-admin/edit.php?post_type=classes" title="classes are often videos but can be other content as well" class="btn col-12 btn-lg btn-dark">Classes</a></div>
  	<div class="col-md-2"><a href="/wp-admin/nav-menus.php" title="your payments portal" class="btn btn-lg px-0 col-12 btn-dark">Payments</a></div>
  </div>';



// Don’rtemove this one here below
}
function custom_post_type() {

	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Courses', 'Post Type General Name', 'twentytwenty' ),
			'singular_name'       => _x( 'Courses', 'Post Type Singular Name', 'twentytwenty' ),
			'menu_name'           => __( 'Courses', 'twentytwenty' ),
			'parent_item_colon'   => __( 'Parent Course', 'twentytwenty' ),
			'all_items'           => __( 'All Courses', 'twentytwenty' ),
			'view_item'           => __( 'View Course', 'twentytwenty' ),
			'add_new_item'        => __( 'Add New Course', 'twentytwenty' ),
			'add_new'             => __( 'Add New', 'twentytwenty' ),
			'edit_item'           => __( 'Edit Course', 'twentytwenty' ),
			'update_item'         => __( 'Update Course', 'twentytwenty' ),
			'search_items'        => __( 'Search Course', 'twentytwenty' ),
			'not_found'           => __( 'Not Found', 'twentytwenty' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
		);

	// Set other options for Custom Post Type

		$args = array(
			'label'               => __( 'courses', 'twentytwenty' ),
			'description'         => __( 'A selection of lessons', 'twentytwenty' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy.
			'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'course',
			'map_meta_cap'  	  => true,
			'show_in_rest' => false,

		);

		// Registering your Custom Post Type
		register_post_type( 'courses', $args );

			// Set UI labels for Custom Post Type
			$classlabels = array(
				'name'                => _x( 'Classes', 'Post Type General Name', 'twentytwenty' ),
				'singular_name'       => _x( 'Classes', 'Post Type Singular Name', 'twentytwenty' ),
				'menu_name'           => __( 'Classes', 'twentytwenty' ),
				'parent_item_colon'   => __( 'Parent Class', 'twentytwenty' ),
				'all_items'           => __( 'All Classes', 'twentytwenty' ),
				'view_item'           => __( 'View Class', 'twentytwenty' ),
				'add_new_item'        => __( 'Add New Class', 'twentytwenty' ),
				'add_new'             => __( 'Add New', 'twentytwenty' ),
				'edit_item'           => __( 'Edit Class', 'twentytwenty' ),
				'update_item'         => __( 'Update Class', 'twentytwenty' ),
				'search_items'        => __( 'Search Class', 'twentytwenty' ),
				'not_found'           => __( 'Not Found', 'twentytwenty' ),
				'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
			);

		// Set other options for Custom Post Type

			$classargs = array(
				'label'               => __( 'Classes', 'twentytwenty' ),
				'description'         => __( 'A selection of lessons', 'twentytwenty' ),
				'labels'              => $classlabels,
				// Features this CPT supports in Post Editor
				'supports'            => array( 'title', 'editor', 'author', 'comments', 'custom-fields', ),
				// You can associate this CPT with a taxonomy or custom taxonomy.
				'taxonomies'          => array( 'genres' ),
				/* A hierarchical CPT is like Pages and can have
				* Parent and child items. A non-hierarchical CPT
				* is like Posts.
				*/
				'hierarchical'        => false,
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'show_in_admin_bar'   => true,
				'menu_position'       => 5,
				'can_export'          => true,
				'has_archive'         => true,
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'capability_type'     => 'class',
				'map_meta_cap'  	  => true,
				'show_in_rest' 		  => true,

			);

		$watcheslabels = array(
			'name'                => _x( 'Watches', 'Post Type General Name', 'twentytwenty' ),
			'singular_name'       => _x( 'Watches', 'Post Type Singular Name', 'twentytwenty' ),
			'all_items'           => __( 'All Watches', 'twentytwenty' ),
			'add_new_item'        => __( 'Add New watch', 'twentytwenty' ),
			'edit_item'           => __( 'Edit Watch', 'twentytwenty' ),
			'update_item'         => __( 'Update Watch', 'twentytwenty' ),
			'search_items'        => __( 'Search Watch', 'twentytwenty' ),
			'not_found'           => __( 'Not Found', 'twentytwenty' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
		);

	// Set other options for Custom Post Type

		$watchesargs = array(
			'label'               => __( 'watches', 'twentytwenty' ),
			'description'         => __( 'tracking of which videos students have already watched', 'twentytwenty' ),
			'labels'              => $watcheslabels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title' ),
			// You can associate this CPT with a taxonomy or custom taxonomy.
			'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest' 		  => false,

		);
		$courseslabels = array(
			'name'                => _x( 'Course Ownership', 'Post Type General Name', 'twentytwenty' ),
			'singular_name'       => _x( 'Course Ownership', 'Post Type Singular Name', 'twentytwenty' ),
			'all_items'           => __( 'All Courses Owned', 'twentytwenty' ),
			'add_new_item'        => __( 'Add New Course Ownership', 'twentytwenty' ),
			'edit_item'           => __( 'Edit Course Ownership', 'twentytwenty' ),
			'update_item'         => __( 'Update Course Ownership', 'twentytwenty' ),
			'search_items'        => __( 'Search Course Ownership', 'twentytwenty' ),
			'not_found'           => __( 'Not Found', 'twentytwenty' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),
		);

	// Set other options for Custom Post Type

		$coursesargs = array(
			'label'               => __( 'watches', 'twentytwenty' ),
			'description'         => __( 'tracking of which videos students have already watched', 'twentytwenty' ),
			'labels'              => $courseslabels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title' ),
			// You can associate this CPT with a taxonomy or custom taxonomy.
			'taxonomies'          => array( 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest' 		  => false,

		);

		// Registering your Custom Post Type
			register_post_type( 'watches', $watchesargs );
			register_post_type( 'coursesowned', $coursesargs );
			register_post_type( 'courses', $args );
			register_post_type( 'classes', $classargs );

	}

	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not
	* unnecessarily executed.
	*/

	add_action( 'init', 'custom_post_type', 0 );

// Register a courses ACF Block
if( function_exists('acf_register_block') ) {

	$result = acf_register_block(array(
		'name'				=> 'courses',
		'title'				=> __('courses'),
		'description'		=> __('A custom courses block.'),
		'render_callback'	=> 'courses_block_html'
		//'category'		=> '',
		//'icon'			=> '',
		//'keywords'		=> array(),
	));
}
wp_enqueue_script( 'customjs', get_theme_file_uri( '/assets/js/custom.js' ));
add_action('rest_api_init', 'watchedRoutes');
function watchedRoutes() {
	register_rest_route('api/v1', 'manageWatches/', array(
		'methods' => 'POST',
		'callback' => 'createWatch'
	));
	register_rest_route('api/v1', 'manageWatches/', array(
		'methods' => 'DELETE',
		'callback' => 'deleteWatch'
	));
}

function createWatch($data) {
	$class_id = $data['class_id'];
	$user_id = $data['user_id'];
	return wp_insert_post(array(
		'post_type' => 'watches',
		'post_status' => 'publish',
		'post_title' => 'video watched',
		'meta_input' => array(
			'class_id' => $class_id,
			'user_id' => $user_id,
			)
		));
}
function deleteWatch($data) {
	$post_id = $data['delete_post']['id'];
	wp_delete_post($post_id);
	return $data['delete_post'];
}

// redirect non admin users out of admin and onto homepage
add_action('admin_init', 'redirectStudentsToFrontend');

function redirectStudentsToFrontend() {
	$currentUser = wp_get_current_user();
	if(!in_array("administrator", $currentUser->roles)) {
		wp_redirect(site_url('/'));
		exit;
	}
}

add_action('wp_loaded', 'removeAdminBar');

function removeAdminBar() {
	$currentUser = wp_get_current_user();
	if(!in_array("administrator", $currentUser->roles)) {
		show_admin_bar(false);
	}
}

// customize login screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
	return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'loginCSS');

function loginCss() {
	wp_enqueue_style( 'logincss', get_theme_file_uri( '/assets/css/login.css' ));
}

function my_wp_nav_menu_args( $args = '' ) {

	if( is_user_logged_in() ) {
		$args['menu'] = 'logged-in';
	} else {
		$args['menu'] = 'logged-out';
	}
		return $args;
	}
	add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

add_action('rest_api_init', 'paymentRoute');
function paymentRoute() {
	register_rest_route('api/v1', 'payment/', array(
		'methods' => 'POST',
		'callback' => 'payment'
	));
}

function payment($data) {

	$amount = $data['unit_amount'];
	$image = $data['image'];
	$title = $data['title'];
	$success = $data['success_url'];
	$cancel = $data['cancel_url'];
	$user_id = $data['user_id'];
	$course_id = $data['course_id'];

	$YOUR_DOMAIN = get_site_url();

	\Stripe\Stripe::setApiKey(get_field('private_key', 301));
	try{
	$checkout_session = \Stripe\Checkout\Session::create([
		'payment_method_types' => ['card'],
		'line_items' => [[
		  'price_data' => [
			'currency' => 'usd',
			'unit_amount' => $amount,
			'product_data' => [
			  'name' => $title,
			  'images' => [$image],
			],
		  ],
		  'quantity' => 1,
		]],
		'metadata'=> array(
			'user_id' => $user_id,
			'course_id' => $course_id
		),
		'mode' => 'payment',
		'success_url' => $success,
		'cancel_url' => $cancel,
	  ]);
	} catch (Exception $e) {
		error_log($e->getMessage());
	}
	//   header("HTTP/1.1 303 See Other");
	//   header("Location: " . $checkout_session->url);
	  return $checkout_session;
}

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/twentyseventeen/stripe/stripe-php/init.php');

add_action('rest_api_init', 'purchasedRoutes');
function purchasedRoutes() {
	register_rest_route('api/v1', 'purchased/', array(
		'methods' => 'POST',
		'callback' => 'purchased'
	));
}
// capture stripe webhooks for both subscriptions and course purchases
function purchased($data) {

	\Stripe\Stripe::setApiKey(get_field('private_key', 301));
	$endpoint_secret = get_field('endpoint_secret', 301);
	$payload = @file_get_contents('php://input');
	$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
	$event = null;
	try {
		$event = \Stripe\Webhook::constructEvent(
			$payload, $sig_header, $endpoint_secret
		);
	} catch(\UnexpectedValueException $e) {
		// Invalid payload
		error_log("1088: unexpectedValue".$e);
		http_response_code(400);
		exit();
	} catch(\Stripe\Exception\SignatureVerificationException $e) {
		// Invalid signature
		error_log("1093: invalidSignature: ".$e);
		http_response_code(400);
		exit();
	}

	switch ($event->type) {
		case 'checkout.session.completed':
			$paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
			if($paymentIntent->mode != "subscription") {
				award_ownership($paymentIntent->metadata);
				error_log("checkout.session.completed".$paymentIntent->metadata);
			}
			break;
			case 'invoice.paid':
				error_log('invoice.paid');
				$paymentIntent = $event->data->object;
				if($paymentIntent->status == "paid") {
					subscriptionConfirmed($paymentIntent->customer, $paymentIntent->subscription, true);
				} else {
					error_log('alternative status (other than paid): '.$paymentIntent->id);
				}
				break;
			case 'customer.subscription.deleted':
				error_log('customer.subscription.deleted');
				$paymentIntent = $event->data->object;
				finalCancel($paymentIntent->customer, $paymentIntent->current_period_end);
				break;
		default:
			$paymentIntent = $event->data->object;
			error_log('Received unknown event type ' . $event->type);
	}
	http_response_code(200);
}
function finalCancel($customer_id, $end_date) {
	$stripe = new \Stripe\StripeClient(get_field('private_key', 301));
	$customer = $stripe->customers->retrieve(
	  $customer_id,
	  []
	);
	$user_id = $customer->metadata->user_id;
	update_field('end_date', $end_date, "user_$user_id");
}
function award_ownership($data) {
	$user_id = $data->user_id;
	$course_id = $data->course_id;
	$user_info = WP_User::get_data_by( 'ID', $user_id );
	global $wpdb;
	$results = $wpdb->get_results('SELECT * FROM wp_posts INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id WHERE wp_posts.post_type = "coursesowned" AND wp_posts.post_status = "publish"  ');
	$post_id;
	foreach($results as $result) {
		if($result->meta_key == "user_id") {
			if($result->meta_value == $user_id) {
				$post_id = $result->post_id;
			}
		}
	}
	if($post_id) {
		$courses = get_field('course_id', $post_id);
		if(is_array($courses)) {
			array_push($courses, $course_id);
		} else {
			$courses = array([0] => $course_id);
		}
		update_field('course_id', $courses, $post_id);
	} else {
		$new_post = array(
			'post_author' => 0,
			'post_title' => $user_info->user_login,
			'post_status' => 'publish',
			'post_type' => 'coursesowned'
		);
		$new_post = wp_insert_post($new_post);
		if($new_post != 0) {
			$arr = array($course_id);
			update_field('course_id', $arr, $new_post);
			update_field('user_id', $user_id, $new_post);
		}
	}
}

function subscriptionConfirmed($customer_id, $subscription_id, $status) {
	$stripe = new \Stripe\StripeClient(get_field('private_key', 301));
	  $customer = $stripe->customers->retrieve(
		$customer_id,
		[]
	  );
	  $user_id = $customer->metadata->user_id;
	$user = wp_update_user( array( 'ID' => $user_id, 'role' => 'student_subscriber' ));
	update_field('subscription', $subscription_id, "user_$user_id");
	update_field('customer', $customer_id, "user_$user_id");
}

add_action('rest_api_init', 'subscriptionRoute');
function subscriptionRoute() {
	register_rest_route('api/v1', 'subscription/', array(
		'methods' => 'POST',
		'callback' => 'subscription'
	));
	register_rest_route('api/v1', 'subscription/', array(
		'methods' => 'DELETE',
		'callback' => 'blockAccess'
	));
	register_rest_route('api/v1', 'subscribed/', array(
		'methods' => 'GET',
		'callback' => 'subscribed'
	));

	register_rest_route('api/v1', 'cancelSubscription/', array(
		'methods' => 'POST',
		'callback' => 'cancelSubscription'
	));
}
// interact with stripe creating a customer, then a session based on that customer
function subscription($data) {
	$amount = $data['unit_amount'];
	$image = $data['image'];
	$title = $data['title'];
	$success = $data['success_url'];
	$cancel = $data['cancel_url'];
	$user_id = $data['user_id'];
	$priceId = get_field('price_id', 301);
	$YOUR_DOMAIN = get_site_url();
	$user_info = WP_User::get_data_by( 'ID', $user_id );
	try{
		$stripe = new \Stripe\StripeClient( get_field('private_key', 301) );
		$customer = $stripe->customers->create([
		'email' => $user_info->data->user_email,
		'description' => 'My First Test Customer (created for API docs)',
		"metadata" => ["user_id" => $user_id],
		]);

	\Stripe\Stripe::setApiKey(get_field('private_key', 301));
	$checkout_session = \Stripe\Checkout\Session::create([
		'client_reference_id' => $customer->id,
		'customer' => $customer->id,
		'success_url' => $success,
		'cancel_url' => $cancel,
		'payment_method_types' => ['card'],
		'mode' => 'subscription',
		'line_items' => [[
		  'price' => $priceId,
		  'quantity' => 1,
		]],
	  ]);
	
	} catch (Exception $e) {
		error_log($e->getMessage());
	}
	//   header("HTTP/1.1 303 See Other");
	//   header("Location: " . $checkout_session->url);
	  return $checkout_session;
}

function subscribed($data) {
	$user_id = $_GET['user_id'];
}

function cancelSubscription($data) {
	try{
		$user_id = $data['user_id'];
		\Stripe\Stripe::setApiKey(get_field('private_key', 301));

		\Stripe\Subscription::update(
		get_field('subscription', "user_$user_id"),
		[
			'cancel_at_period_end' => true,
		]
		);
		$stripe = new \Stripe\StripeClient(get_field('private_key', 301));
		$sub = $stripe->subscriptions->cancel(
			get_field('subscription', "user_$user_id"),
			[]
		);
		
	} catch (Exception $e) {
		error_log($e->getMessage()); 
	}
	return $sub;
}
function blockAccess($data) {
	error_log('block access');
	$user_id = $data['user_id'];
	$user = wp_update_user( array( 'ID' => $user_id, 'role' => 'student' ));
	update_field('end_date', '', "user_$user_id");
	update_field('subscription', '', "user_$user_id");
	return true;
} 