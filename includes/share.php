<?php
/**
 *
 * Post Meta Template Functions.
 * Print HTML with a share buttons.
 *
 */

function kb_share_buttons( $args = array(), $config = array() ) {

	/**
	 * Default social networks.
	 *
	 * @since 1.0.0
	 *
	 * $1%s - `id`
	 * $2%s - `type`
	 * $3%s - `url`
	 * $4%s - `title`
	 * $5%s - `summary`
	 * $6%s - `thumbnail`
	 */

    $facebook_icon  = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.25 4.5H18V0H14.25C11.355 0 9 2.355 9 5.25V7.5H6V12H9V24H13.5V12H17.25L18 7.5H13.5V5.25C13.5 4.8435 13.8435 4.5 14.25 4.5Z" fill="currentColor"/></svg>';
    $twitter_icon   = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.7499 5.96017C21.0327 6.26954 20.2522 6.4922 19.4483 6.57892C20.283 6.08306 20.908 5.2997 21.2061 4.37579C20.4229 4.8417 19.5649 5.16841 18.6702 5.34142C18.2963 4.94163 17.844 4.62315 17.3415 4.40581C16.8391 4.18847 16.2973 4.07693 15.7499 4.07813C13.5351 4.07813 11.7538 5.87345 11.7538 8.07657C11.7538 8.38595 11.7913 8.69532 11.8522 8.99298C8.53584 8.81954 5.57803 7.23517 3.61162 4.80938C3.25332 5.42137 3.06556 6.1182 3.06787 6.82735C3.06787 8.21485 3.77334 9.43829 4.84912 10.1578C4.21515 10.1329 3.59602 9.9586 3.04209 9.64923V9.69845C3.04209 11.6414 4.41553 13.2516 6.246 13.6219C5.90231 13.7112 5.54875 13.7568 5.19365 13.7578C4.9335 13.7578 4.6874 13.732 4.43896 13.6969C4.94521 15.2813 6.41943 16.432 8.1749 16.4695C6.80146 17.5453 5.08115 18.1781 3.21318 18.1781C2.87803 18.1781 2.56865 18.1664 2.24756 18.1289C4.01943 19.2656 6.12178 19.9219 8.38584 19.9219C15.7358 19.9219 19.7577 13.8328 19.7577 8.54767C19.7577 8.37423 19.7577 8.20079 19.746 8.02735C20.5241 7.45782 21.2062 6.75235 21.7499 5.96017Z" fill="#CBD5E1"/></svg>';
    $linkedin_icon  = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.17092 5.00904C7.17092 6.21744 6.19132 7.19704 4.98292 7.19704C3.77452 7.19704 2.79492 6.21744 2.79492 5.00904C2.79492 3.80065 3.77452 2.82104 4.98292 2.82104C6.19132 2.82104 7.17092 3.80065 7.17092 5.00904ZM9.23697 20.9939V8.85493H12.855V10.5149H12.906C13.409 9.56193 14.639 8.55493 16.474 8.55493C20.296 8.55493 21 11.0679 21 14.3379V20.9949H17.229V15.0909C17.229 13.6839 17.205 11.8729 15.268 11.8729C13.304 11.8729 13.006 13.4069 13.006 14.9909V20.9939H9.23697ZM6.86997 8.85493H3.09497V20.9939H6.86997V8.85493Z" fill="#CBD5E1"/></svg>';
    $pinterest_icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.99 2C6.472 2 2 6.473 2 11.99C2 16.222 4.633 19.84 8.35 21.296C8.262 20.506 8.184 19.29 8.384 18.428C8.566 17.648 9.556 13.462 9.556 13.462C9.556 13.462 9.257 12.863 9.257 11.978C9.257 10.59 10.062 9.553 11.065 9.553C11.918 9.553 12.329 10.193 12.329 10.96C12.329 11.818 11.783 13.099 11.502 14.287C11.267 15.281 12.001 16.092 12.981 16.092C14.756 16.092 16.122 14.22 16.122 11.517C16.122 9.125 14.403 7.453 11.949 7.453C9.106 7.453 7.437 9.585 7.437 11.788C7.437 12.646 7.768 13.567 8.181 14.068C8.2161 14.1057 8.24088 14.1519 8.25297 14.202C8.26505 14.2521 8.26403 14.3044 8.25 14.354C8.174 14.669 8.005 15.348 7.973 15.487C7.929 15.67 7.828 15.709 7.638 15.621C6.391 15.04 5.611 13.216 5.611 11.75C5.611 8.599 7.9 5.705 12.212 5.705C15.678 5.705 18.371 8.174 18.371 11.475C18.371 14.919 16.2 17.688 13.187 17.688C12.174 17.688 11.223 17.163 10.897 16.542L10.274 18.916C10.049 19.784 9.44 20.872 9.033 21.536C9.99111 21.8318 10.9883 21.9818 11.991 21.981C17.508 21.981 21.981 17.508 21.981 11.991C21.981 6.474 17.507 2 11.99 2Z" fill="#CBD5E1"/></svg>';

    $defaults = apply_filters( 'kb_default_args_share_buttons', array(

		'facebook' => array(
			'icon'      => $facebook_icon,
			'name'      => esc_html__( 'Facebook', 'knowledge-base' ),
			'share_url' => 'https://www.facebook.com/sharer/sharer.php?u=%3$s&t=%4$s',
		),
		'twitter' => array(
			'icon'      => $twitter_icon,
			'name'      => esc_html__( 'Twitter', 'knowledge-base' ),
			'share_url' => 'https://twitter.com/intent/tweet?url=%3$s&text=%4$s',
		),
		'linkedin' => array(
			'icon'      => $linkedin_icon,
			'name'      => esc_html__( 'LinkedIn', 'knowledge-base' ),
			'share_url' => 'https://www.linkedin.com/shareArticle?mini=true&url=%3$s&title=%4$s&summary=%5$s&source=%3$s',
		),
		'pinterest' => array(
			'name'      => esc_html__( 'Pinterest', 'knowledge-base' ),
			'icon'      => $pinterest_icon,
			'share_url' => 'https://www.pinterest.com/pin/create/button/?url=%3$s&description=%4$s&media=%6$s',
		),

	) );

	$networks = wp_parse_args( $args, $defaults );

	$default_config = apply_filters( 'kb_default_config_share_buttons', array(
		'http'         => is_ssl() ? 'https' : 'http',
		'custom_class' => '',
	) );

	$config = wp_parse_args( $config, $default_config );

	// Prepare a data for sharing.
	$id           = get_the_ID();
	$type         = get_post_type( $id );
	$url          = get_permalink( $id );
	$title        = get_the_title( $id );
	$summary      = get_the_excerpt();
	$thumbnail_id = get_post_thumbnail_id( $id );
	$thumbnail    = '';

	if ( ! empty( $thumbnail_id ) ) {
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id, 'full' );
		$thumbnail = $thumbnail[0];
	}

    $share_item_html = apply_filters( 'kb_share_button_html',
		'<div class="kb-share-item d-inline-flex text-size-null"><a class="share__item-link %2$s" href="%1$s" target="_blank" rel="nofollow" title="%3$s">%4$s</a></div>'
	);
	$share_buttons = '';

	foreach ( (array) $networks as $id => $network ) :

		if ( empty( $network['share_url'] ) ) {
			continue;
		}

		$share_url = sprintf( $network['share_url'],
			urlencode( $id ),
			urlencode( $type ),
			urlencode( $url ),
			urlencode( $title ),
			urlencode( $summary ),
			urlencode( $thumbnail )
		);

		$share_buttons .= sprintf(
			$share_item_html,
			htmlentities( $share_url ),
			sanitize_html_class( $id ),
			esc_html__( 'Share on ', 'knowledge-base' ) . $network['name'],
            $network['icon'],
			esc_attr( $network['name'] )
		);

	endforeach;

    echo '<div class="d-none d-xxl-inline-flex flex-column position-fixed kb-share">';
	    echo $share_buttons;
    echo '</div>';

}