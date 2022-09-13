<?php
/**
 * Custom functions that act independently of the theme templates.
 */

add_shortcode( 'post_title', 'kb_post_title' );

function kb_post_format_checker() {

    $standart     = kb_get_icon_svg( 'article' );
    $video        = kb_get_icon_svg( 'youtube' );
    $tips_tricks  = kb_get_icon_svg( 'article-tips' );
    $troubleshoot = kb_get_icon_svg( 'article-troubleshoot' );

    $post_id = get_the_ID();
    $post_type = get_post_type( $post_id );
    $format = get_post_format();

    if ( $post_type === 'tips-and-tricks' ) {
        echo $tips_tricks;
    } elseif ( $post_type === 'troubleshooting' ) {
        echo $troubleshoot;
    } elseif ( $format === false ) {
        echo $standart;
    }

    if ( $format === 'video' ) {
        echo $video;
    }

}

function kb_post_title() {

    $post_id = get_the_ID();
    $title = get_post_field( 'post_title', $post_id );
    $label = get_post_meta( $post_id, 'post-label', true );

    ob_start();

    if ( ! empty( $label ) ) {
        $post_title = $label;
    } else {
        $post_title = $title;
    }

    echo $res = sprintf('%1$s%2$s', kb_post_format_checker(), $post_title );

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
    } elseif ( $post_type === 'troubleshooting' ) {
        $icon = kb_get_icon_svg( 'article-troubleshoot' );
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
                <div class="jet-ajax-search__icon-box text-size-null mr-12">{{{data.post_icon}}}</div>
                <a class="jet-ajax-search__link" href="{{{data.link}}}" target="{{{data.link_target_attr}}}">{{{data.title}}}</a>
            </div>';
}

add_shortcode( 'breadcrumbs', 'kb_breadcrumbs' );

function kb_breadcrumbs( $rules, $post ) {

    $post_id = get_the_ID();
    $title = get_post_field( 'post_title', $post_id );
    $arrow = '<svg class="mx-4" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.99992 3L4.29492 3.705L6.58492 6L4.29492 8.295L4.99992 9L7.99992 6L4.99992 3Z" fill="#64748B"/></svg>';
    $post_type = get_post_type();
    $post_type_queried = get_queried_object();
    $post_type_object = get_post_type_object( get_post_type() );

    $front = '';
    $slug = '';
    $res = '';

    $home = home_url();

    ob_start();

    if ( is_search() ) {
        return;
    }

    if ( ! is_front_page() ) {
        $front = sprintf('<a class="smaller text-jetpopup font-weight-medium" href="%1$s">Knowledge base</a> %2$s', $home, $arrow );
    }

    $rel = jet_engine()->relations->get_active_relations( CROCO_KB_POSTS_REL );
    $parents = $rel->get_parents( $post_id, 'ids' );

    if ( ! empty( $parents ) ) {
        $parent_post = get_post( $parents[0] );
    }

    if ( is_singular('article') && ! empty( $parents ) ) {
        $res = sprintf('<a class="text-jetpopup font-weight-medium" href="%1$s/plugins/">Plugins</a> %2$s <a href="%1$s/plugins/%3$s/">%4$s</a> %2$s', $home, $arrow, $parent_post->post_name, $parent_post->post_title );
    } elseif ( is_singular('jetplugins') ) {
        $res = sprintf('<a class="text-jetpopup font-weight-medium" href="%1$s/plugins/">Plugins</a> %2$s', $home, $arrow );
    }

    if ( is_post_type_archive('tips-and-tricks') || is_post_type_archive('troubleshooting') ) {
        echo sprintf('<div class="kb-breadcrumbs d-flex smaller">%1$s %2$s</div>', $front, $post_type_queried->labels->singular_name );
    } elseif ( is_singular('tips-and-tricks') || is_singular('troubleshooting') ) {
        $res = sprintf('<a class="text-jetpopup font-weight-medium" href="%1$s/%2$s/">%3$s</a> %4$s', $home, $post_type, $post_type_object->labels->singular_name, $arrow );
        echo sprintf('<div class="kb-breadcrumbs d-flex smaller">%1$s %2$s %3$s</div>', $front, $res, $title );
    } else {
        echo sprintf('<div class="kb-breadcrumbs d-flex smaller">%1$s %2$s %3$s</div>', $front, $res, $title );
    }

    return ob_get_clean();

}

add_shortcode( 'related_materials', 'kb_related_materials' );

function kb_related_materials() {

    ob_start();

    global $post;

    $post_id = get_the_ID();
    $ids = get_post_meta( $post_id, 'related-materials', true );

    $posts = get_posts(
        array(
            'post_type' => array('tips-and-tricks', 'troubleshooting', 'article'),
            'orderby'        => 'ID',
            'order'          => 'ASC',
            'posts_per_page' => -1,
            'post__in' => $ids,
        )
    );

    ?><h2 class="h5 mb-4">Related materials</h2><?php
    ?><div class="jet-listing-grid__items">
        <?php
            foreach( $posts as $post ){
                setup_postdata( $post );
                ?><div class="jet-listing-grid__item">
                    <div class="jet-listing-dynamic-link custom-jet-listing">
                        <a href="<?php the_permalink() ?>" class="jet-listing-dynamic-link__link">
                            <span class="jet-listing-dynamic-link__label"><?php echo do_shortcode('[post_title]'); ?></span>
                        </a>
                    </div>
                </div><?php
            } wp_reset_postdata();
            ?></div><?php

    return ob_get_clean();

}

add_shortcode( 'video_box', 'kb_video_box' );

function kb_video_box() {

    $post_id = get_the_ID();

    $url = get_post_meta( $post_id, 'youtube-url', true );
    $desc = get_post_meta( $post_id, 'video-description', true );

    ob_start();

    if ( get_post_meta( $post_id, 'youtube-url', true ) !== '' ) {
        ?><div class="overflow-hidden border border-200 rounded mb-60 d-none d-md-block">
        <iframe width="360" height="202" src="https://www.youtube.com/embed/<?php echo $url ?>" title="<?php echo $desc; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="p-20">
        <p class="small mb-8"><?php echo $desc; ?></p>
        <a href="https://youtu.be/<?php echo $url ?>" target="_blank" rel="nofollow" class="btn btn-custom btn-without-fill btn-sm btn-color-inverse btn-jetpopup btn-effect-1">
            <span>Watch video</span>
            <svg class="btn-icon ml-12" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.99997 6L8.58997 7.41L13.17 12L8.58997 16.59L9.99997 18L16 12L9.99997 6Z" fill="#0F172A"></path>
            </svg>
        </a></div>
        </div><?php
    }

    return ob_get_clean();

}