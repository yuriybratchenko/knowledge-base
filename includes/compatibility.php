<?php
/**
 * Compatibility
 */


// API Access
add_filter( 'croco-site-menu/rest/url', function() {
    return 'https://crocoblock.com/wp-json/';
} );

// SVG Support
add_filter('upload_mimes', 'svg_upload_allow');

function svg_upload_allow($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    return $mimes;
}

add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '') {
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

// Wpseo compatibility
function kb_wpseo_robots( $robotsstr ) {
    if ( is_search() ) {
        return 'noindex, nofollow';
    }
    if ( isset( $_GET['utm_source'] ) || isset( $_GET['ref'] ) ) {
        return 'noindex, nofollow';
    }
    return $robotsstr;
}

add_filter( 'wpseo_robots', 'kb_wpseo_robots' );