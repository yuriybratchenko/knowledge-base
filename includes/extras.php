<?php
/**
 * Custom functions that act independently of the theme templates.
 */

add_shortcode( 'icon_post', 'kb_post_format_checker' );

function kb_post_format_checker() {

    $standart     = kb_get_icon_svg( 'article' );
    $video        = kb_get_icon_svg( 'youtube' );
    $tips_tricks  = kb_get_icon_svg( 'article-tips' );

    ob_start();

    $format = get_post_format();

    if ( is_singular('tips-and-tricks') ) {
        echo $tips_tricks;
    } elseif ( $format === false ) {
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

add_filter( 'jet-ajax-search/results_item_js_template', 'kb_search_results_mod');
add_filter( 'jet-search/ajax-search/custom-post-data', 'kb_custom_fields', 10, 3 );

function kb_custom_fields( $item, $data, $post ) {
    $post_type = get_post_type( $post->ID );
    $format = get_post_format( $post->ID );

    if ( $post_type === 'tips-and-tricks' ) {
        $icon = kb_get_icon_svg( 'article-tips' );
        $class = $post_type;
    } elseif ( $format === false ) {
        $icon = kb_get_icon_svg( 'article' );
    }

    if ( $format === 'video' ) {
        $icon = kb_get_icon_svg( 'youtube' );
        $class = 'video';
    }

    return array( 'post_icon' => $icon, 'post_class' => $class );
}

function kb_search_results_mod( $template ) {
    return '<div class="jet-ajax-search__item d-flex {{{data.post_class}}}">
                <div class="jet-ajax-search__icon-box mr-12">{{{data.post_icon}}}</div>
                <a class="jet-ajax-search__link" href="{{{data.link}}}" target="{{{data.link_target_attr}}}">{{{data.title}}}</a>
            </div>';
}