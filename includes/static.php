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

add_shortcode( 'need_help_cl', 'kb_need_help_cl' );

function kb_need_help_cl() {

    ob_start();
    include get_theme_file_path('tmp/need-help-cl.php');
    return ob_get_clean();

}

add_shortcode( 'use_croco', 'kb_use_croco' );

function kb_use_croco() {

    ob_start();
        include get_theme_file_path('tmp/use-croco.php');
    return ob_get_clean();

}

add_shortcode( 'learn_multivendor', 'kb_learn_multivendor' );

function kb_learn_multivendor() {

    ob_start();
        include get_theme_file_path('tmp/learn-multivendor.php');
    return ob_get_clean();

}

add_shortcode( 'suggest-your-tip', 'kb_suggest_your_tip' );

function kb_suggest_your_tip() {

    ob_start();
    include get_theme_file_path('tmp/suggest-your-tip.php');
    return ob_get_clean();

}