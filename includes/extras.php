<?php
/**
 * Custom functions that act independently of the theme templates.
 */

add_shortcode( 'icon_post', 'kb_post_format_checker' );

function kb_post_format_checker() {

    $standart = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M19 3H5C3.9 3 3 3.9 3 5V19C3 20.1 3.9 21 5 21H19C20.1 21 21 20.1 21 19V5C21 3.9 20.1 3 19 3ZM14 17H7V15H14V17ZM17 13H7V11H17V13ZM17 9H7V7H17V9Z" fill="#64748B"/></g></svg>';
    $video    = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g opacity="0.5"><path d="M22.0617 6.93984C21.9422 6.49462 21.7078 6.0886 21.382 5.76243C21.0563 5.43625 20.6505 5.20136 20.2055 5.08125C18.5672 4.64063 12 4.64062 12 4.64062C12 4.64062 5.43281 4.64062 3.79453 5.07891C3.34927 5.19862 2.94334 5.43339 2.61751 5.75962C2.29169 6.08586 2.05744 6.49208 1.93828 6.9375C1.5 8.57812 1.5 12 1.5 12C1.5 12 1.5 15.4219 1.93828 17.0602C2.17969 17.9648 2.89219 18.6773 3.79453 18.9188C5.43281 19.3594 12 19.3594 12 19.3594C12 19.3594 18.5672 19.3594 20.2055 18.9188C21.1102 18.6773 21.8203 17.9648 22.0617 17.0602C22.5 15.4219 22.5 12 22.5 12C22.5 12 22.5 8.57813 22.0617 6.93984ZM9.91406 15.1406V8.85938L15.3516 11.9766L9.91406 15.1406Z" fill="#FA5450"/></g></svg>';

    ob_start();

    $format = get_post_format();

    if ( $format === false ) {
        echo $standart;
    }

    if ( $format === 'video' ) {
        echo $video;
    }

    return ob_get_clean();

}

add_shortcode( 'plugin_logo', 'kb_plugin_logo' );

function kb_plugin_logo() {

    $post_id = get_the_ID();
    $slug = get_post_field( 'post_name', $post_id );
    $key = get_post_meta( $post_id, 'logo', true );

    ob_start();

    if ( $key ) {
        echo sprintf('<div class="d-flex align-items-center justify-content-center bg-%1$s logo">%2$s</div>', $slug, $key );
    }

    return ob_get_clean();

}