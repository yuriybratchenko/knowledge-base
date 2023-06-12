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
    $feature      = kb_get_icon_svg( 'feature' );

    $post_id = get_the_ID();
    $post_type = get_post_type( $post_id );
    $format = get_post_format();

    if ( $post_type === 'tips-and-tricks' ) {
        echo $tips_tricks;
    } elseif ( $post_type === 'troubleshooting' ) {
        echo $troubleshoot;
    } elseif ( $post_type === 'features' ) {
        echo $feature;
    } elseif ( $format === false ) {
        echo $standart;
    }

    if ( $format === 'video' && $post_type !== 'features' ) {
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
    } elseif ( $post_type === 'features' ) {
        $icon = kb_get_icon_svg( 'feature' );
        $class = $post_type;
    } elseif ( $post_type === 'troubleshooting' ) {
        $icon = kb_get_icon_svg( 'article-troubleshoot' );
        $class = $post_type;
    } elseif ( $format === false ) {
        $icon = kb_get_icon_svg( 'article' );
    }

    if ( $format === 'video' && $post_type !== 'features' ) {
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

    if ( is_search() || is_404() ) {
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
    } elseif ( is_singular('features') ) {
        $rel = jet_engine()->relations->get_active_relations( 35 );
//        $rel = jet_engine()->relations->get_active_relations( 61 );
        $parents = $rel->get_parents( $post_id, 'ids' );
        if ( ! empty( $parents ) ) {
            $parent_post = get_post( $parents[0] );
        }
        $res = sprintf('<a class="text-jetpopup font-weight-medium" href="%1$s/plugins/">Plugins</a> %2$s <a href="%1$s/plugins/%3$s/">%4$s</a> %2$s <a href="%1$s/%3$s/%3$s-overview/">Feature Overview</a> %2$s', $home, $arrow, $parent_post->post_name, $parent_post->post_title );
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

//    $category = get_the_terms($post->ID, 'catig');
//    foreach ( $category as $cat ) {
//        echo $cat->name;
//        echo '...';
//        echo $cat->slug;
//    }
//
//    var_dump($category);

    return ob_get_clean();

}

add_shortcode( 'related_materials', 'kb_related_materials' );

function kb_related_materials() {

    if( is_admin() ){
       return;
    }

    ob_start();

    global $post;

    $post_id = get_the_ID();
    $ids = get_post_meta( $post_id, 'related-materials', true );

    if ( empty( $ids ) ) {
        return;
    }

    $posts = get_posts(
        array(
            'post_type' => array('tips-and-tricks', 'troubleshooting', 'article'),
            'orderby'        => 'post__in',
//            'order'          => 'ASC',
            'posts_per_page' => -1,
            'post__in' => $ids,
        )
    );

    ?><h2 class="h5 mb-8">Related materials</h2><?php
    ?><div class="jet-listing-grid__items grid-col-desk-1">
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

    if ( is_post_type_archive('tips-and-tricks') ) {
        $url = 'https://www.youtube.com/watch?v=0w0Gx4o94cY&list=PL26jaHWVtLFw9-oWmbiY-YYgO2AsfX9IC';
        $desc = 'Simple and easy-to-follow tutorials aimed at delivering point solutions.';
        $height = 146;
    } else {
        $url = get_post_meta( $post_id, 'youtube-url', true );
        $desc = get_post_meta( $post_id, 'video-description', true );
        $height = 202;
    }

    ob_start();

    if ( get_post_meta( $post_id, 'youtube-url', true ) !== '' || is_post_type_archive('tips-and-tricks' )  ) {
        ?><div class="overflow-hidden border border-200 rounded d-none d-md-block mb-40">
        <iframe width="360" height="<?php echo $height; ?>" src="https://www.youtube.com/embed/<?php echo $url ?>" title="<?php echo $desc; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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

add_shortcode('note', 'kb_note_banner');

function kb_note_banner( $atts ) {

    $default = array(
        'type' => 'info',
        'text' => '',
    );

    $info_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 21C9 21.5 9.4 22 10 22H14C14.6 22 15 21.5 15 21V20H9V21ZM12 2C8.1 2 5 5.1 5 9C5 11.4 6.2 13.5 8 14.7V17C8 17.5 8.4 18 9 18H15C15.6 18 16 17.5 16 17V14.7C17.8 13.4 19 11.3 19 9C19 5.1 15.9 2 12 2Z" fill="#F2D23C"/></svg>';
    $warning_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 21H23L12 2L1 21ZM13 18H11V16H13V18ZM13 14H11V10H13V14Z" fill="#FA5450"/></svg>';

    $res = shortcode_atts( $default, $atts );

    if ( $res['type'] === 'info' ) {
        $svg = $info_svg;
        $border_color = 'jetthemecore';
        $title = 'Things to know';
    } else {
        $svg = $warning_svg;
        $border_color = 'jetsmartfilters';
        $title = 'Warning';
    }

    $html = sprintf('<div class="note-banner d-flex border-bold border-%1$s rounded overflow-hidden p-20"><div class="mr-12">%2$s</div><div class="d-flex flex-column"><div class="text-900 mb-12">%3$s</div><p class="m-0">%4$s</p></div></div>', $border_color, $svg, $title, $res['text'] );

    return $html;
}

function kb_custom_cb_date_mod( $post_id = 0, $field = '', $format = 'F j, Y | G:i' ) {
    return the_modified_date( $format );
}

//add_filter( 'jet-engine/post-type/predifined-columns-cb-for-js', 'kb_get_allowed_admin_columns_cb' );

//function kb_get_allowed_admin_columns_cb( $link ) {
//    return array(
//        'jet_engine_custom_cb_date_mod' => array(
//            'description' => __( 'Format date (from timestamp)', 'jet-engine' ),
//            'args'        => array(
//                'format' => array(
//                    'label'       => __( 'Set format', 'jet-engine' ),
//                    'description' => '<a href="https://wordpress.org/support/article/formatting-date-and-time/">' . __( 'Documentation on date and time formatting', 'jet-engine' ) . '</a>',
//                    'value'       => get_option( 'date_format' ),
//                ),
//            ),
//        ),
//    ) ;
//}

function kb_search_title() {

    global $wp_query;

    ob_start();

    if ( $wp_query->found_posts != 0 ) {
        ?><h2 class="h3 text-center px-20 pb-8"><?php printf( esc_html__( '%2$s results matching ‘%1$s’', 'knowledge-base' ),  get_search_query(), $wp_query->found_posts ); ?></h2><?php
    } else {
        ?><h2 class="h3 text-center px-20 pb-8"><?php printf( esc_html__( 'No results matching ‘%s’', 'knowledge-base' ), get_search_query() ); ?></h2>
        <p class="text-center px-20 m-0">Please, check the spelling or use alternative keywords.</p><?php
        include get_theme_file_path('tmp/browse-cat.php');

    }

    return ob_get_clean();

}

add_shortcode('search_title', 'kb_search_title');

function kb_ajax_search_count() {

    ob_start();

    ?><span class="jet-ajax-search__results-count font-weight-bold"><span></span></span><?php

    return ob_get_clean();

}

add_shortcode('ajax_search_count', 'kb_ajax_search_count');

function kb_custom_offset() {

    global $wp_query;

    ob_start();

    if ( $wp_query->found_posts != 0  ) {
        echo 'pb-80';
    } else {
        echo 'pb-32';
    }

    return ob_get_clean();

}

add_shortcode('custom_offset', 'kb_custom_offset');


function kb_post_excerpt() {

    $post_id = get_the_ID();
    $overview_post = get_post_meta( $post_id, '_overview-post', true );

    ob_start();
    echo get_the_excerpt( $overview_post );
    return ob_get_clean();

}

add_shortcode('post_excerpt', 'kb_post_excerpt');

function kb_table_of_contents_title () {

    ob_start();

    if ( is_singular('features') ) {
        echo 'Settings & Options';
    } else {
        echo 'Table of contents';
    }

    return ob_get_clean();

}

add_shortcode('table_of_contents_title', 'kb_table_of_contents_title');

function kb_cpt_classes () {

    ob_start();

    echo get_post_type();

    return ob_get_clean();

}

add_shortcode('cpt_classes', 'kb_cpt_classes');

add_filter( 'posts_orderby', function ( $order, $query ) {

    if ( ! $query->get( 'jet_ajax_search' ) ) {
        return $order;
    }

    $post_types = $query->get( 'post_type' );

    if ( ! is_array( $post_types ) ) {
        $post_types = array( $post_types );
    }

    $primary_post_types = array( 'features', 'article', 'tips-and-tricks', 'troubleshooting' );

    $post_types = array_merge( $primary_post_types, $post_types );
    $post_types = array_unique( $post_types );

    global $wpdb;

    $post_types_string = "'" . implode( "','", $post_types ) . "'";

    $order = "FIELD( {$wpdb->posts}.post_type, " . $post_types_string . " ), " . $order;

    return $order;
}, 10, 2 );


function kb_modify_logo() {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = sprintf( '<a href="https://crocoblock.com" class="custom-logo-link" rel="home" itemprop="url">%1$s</a>',
        wp_get_attachment_image( $custom_logo_id, 'full', false, array(
            'class'    => 'custom-logo',
            'itemprop' => 'logo'
        ) )
    );

    return $html;
}

add_filter( 'get_custom_logo', 'kb_modify_logo' );