<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class KB_404_Document extends Jet_Document_Base {

	public function get_name() {
		return 'kb_404';
	}

	public static function get_title() {
		return __( 'KB 404', 'knowledge-base' );
	}

}