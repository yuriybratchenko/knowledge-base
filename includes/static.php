<?php
/**
 * Custom functions that act independently of the theme templates.
 */

add_shortcode( 'need_help', 'kb_need_help' );

function kb_need_help() {

    ob_start();
        include get_theme_file_path('tmp/need-help.php');
    return ob_get_clean();

}

add_shortcode( 'use_croco', 'kb_use_croco' );

function kb_use_croco() {

    ob_start();
        include get_theme_file_path('tmp/use-croco.php');
    return ob_get_clean();

}