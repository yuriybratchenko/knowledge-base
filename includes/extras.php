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

add_shortcode( 'breadcrumbs', 'kb_breadcrumbs' );

function kb_breadcrumbs( $rules, $post ) {

    $post_id = get_the_ID();
    $title = get_post_field( 'post_title', $post_id );
    $arrow = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.99992 3L4.29492 3.705L6.58492 6L4.29492 8.295L4.99992 9L7.99992 6L4.99992 3Z" fill="#64748B"/></svg>';

    $front = '';
    $slug = '';
    $res = '';

    $home = home_url();

    ob_start();

    if ( ! is_front_page() ) {
        $front = sprintf('<a href="%1$s">Knowledge base</a> %2$s', $home, $arrow );
    }

    $rel = jet_engine()->relations->get_active_relations( CROCO_KB_POSTS_REL );
    $parents = $rel->get_parents( $post_id, 'ids' );

    if ( is_singular('article') && ! empty( $parents ) ) {
        $parent_post = get_post( $parents[0] );
        $res = sprintf('<a href="%1$s/plugins/">Plugins</a> %2$s <a href="%1$s/plugins/%3$s/">%4$s</a> %2$s', $home, $arrow, $parent_post->post_name, $parent_post->post_title );
    } elseif ( is_singular('jetplugins') ) {
        $res = sprintf('<a href="%1$s/plugins/">Plugins</a> %2$s', $home, $arrow );
    }

    echo sprintf('<div class="kb-breadcrumbs">%1$s %2$s %3$s</div>', $front, $res, $title );
    return ob_get_clean();

}