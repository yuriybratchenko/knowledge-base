<?php
/**
 * Child functions and definitions.
 */
add_filter( 'kava-theme/assets-depends/styles', 'kb_styles_depends' );

/**
 * Enqueue styles.
 */
function kb_styles_depends( $deps ) {

	$parent_handle = 'kava-parent-theme-style';

	wp_register_style(
		$parent_handle,
		get_template_directory_uri() . '/style.css',
		array(),
		kava_theme()->version()
	);

    if ( ! is_admin() ) {
        wp_register_style('google', 'https://fonts.googleapis.com/css2?family=Cabin:wght@400;500;700&display=swap', array(), null, 'all');
        wp_enqueue_style('google');
    }

	$deps[] = $parent_handle;

	return $deps;
}

add_filter( 'kava-theme/assets-depends/script', 'kb_scripts_depends' );

/**
 * Enqueue scripts.
 */
function kb_scripts_depends( $deps ) {

    $parent_handle = 'kava-parent-theme-script';

    wp_enqueue_script(
        $parent_handle,
        get_theme_file_uri( 'js/scripts.js' ),
        array(),
        kava_theme()->version(),
        true
    );

    $deps[] = $parent_handle;

    return $deps;
}

/**
 * Disable magic button for your clients
 *
 * Un-comment next line to disble magic button output for you clients.
 */
//add_action( 'jet-theme-core/register-config', 'kb_disable_magic_button' );

function kb_disable_magic_button( $config_manager ) {
	$config_manager->register_config( array(
		'library_button' => false,
	) );
}

/**
 * Disable unnecessary theme modules
 *
 * Un-comment next line and return unnecessary modules from returning modules array.
 */
//add_filter( 'kava-theme/allowed-modules', 'kb_allowed_modules' );

function kb_allowed_modules( $modules ) {

	return array(
		'blog-layouts'    => array(),
		'crocoblock'      => array(),
		'woo'             => array(
			'woo-breadcrumbs' => array(),
			'woo-page-title'  => array(),
		),
	);

}

/**
 * Registering a new structure
 *
 * To change structure and apropriate documnet type parameters go to
 * structures/archive.php and document-types/archive.php
 *
 * To print apropriate location add next code where you need it:
 * if ( function_exists( 'jet_theme_core' ) ) {
 *     jet_theme_core()->locations->do_location( 'kb_archive' );
 * }
 * Where 'kb_archive' - apropritate location name (from example).
 *
 * Un-comment next line to register new structure.
 */
//add_action( 'jet-theme-core/structures/register', 'kb_structures' );

function kb_structures( $structures_manager ) {

	require get_theme_file_path( 'structures/archive.php' );
	require get_theme_file_path( 'structures/404.php' );

	$structures_manager->register_structure( 'KB_Structure_Archive' );
	$structures_manager->register_structure( 'KB_Structure_404' );

}

/**
 * Load the theme includes.
 */

add_action( 'after_setup_theme', 'kb_includes' );

function kb_includes() {
    require_once get_theme_file_path( 'includes/extras.php' );
    require_once get_theme_file_path( 'includes/static.php' );
    require_once get_theme_file_path( 'includes/share.php' );
    require_once get_theme_file_path( 'includes/classes/svg-icons.php' );
    require_once get_theme_file_path( 'includes/template-tags.php' );
}

/**
 * API Access
 */

add_filter( 'croco-site-menu/rest/url', function() {
    return 'https://crocoblock.com/wp-json/';
} );



add_filter('upload_mimes', 'svg_upload_allow');
function svg_upload_allow($mimes)
{
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);
function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
{
    if (version_compare($GLOBALS['wp_version'], '5.1.0', '>='))
        $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
    else
        $dosvg = ('.svg' === strtolower(substr($filename, -4)));

    if ($dosvg) {
        if (current_user_can('manage_options')) {
            $data['ext']  = 'svg';
            $data['type'] = 'image/svg+xml';
        } else {
            $data['ext'] = $type_and_ext['type'] = false;
        }
    }

    return $data;
}

/**
 * Enqueue custom script for listing grid offset.
 */

wp_enqueue_script('custom-listing-grid', get_theme_file_uri( 'js/custom-offset-listing-grid.js' ) , array(), false, true);