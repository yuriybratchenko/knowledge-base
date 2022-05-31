<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class KB_Archive_Document extends Jet_Document_Base {

	public function get_name() {
		return 'kb_archive';
	}

	public static function get_title() {
		return __( 'KB Archive', 'knowledge-base' );
	}

	public function get_preview_as_query_args() {
		return array(
			'post_type'   => 'post',
			'numberposts' => get_option( 'posts_per_page', 10 ),
		);
	}

}