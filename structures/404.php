<?php

if ( ! class_exists( 'KB_Structure_404' ) ) {

	/**
	 * Define KB_Structure_404 class
	 */
	class KB_Structure_404 extends Jet_Theme_Core_Structure_Base {

		public function get_id() {
			return 'kb_404';
		}

		public function get_single_label() {
			return esc_html__( 'KB 404', 'knowledge-base' );
		}

		public function get_plural_label() {
			return esc_html__( 'KB 404', 'knowledge-base' );
		}

		public function get_sources() {
			return array();
		}

		public function get_document_type() {
			return array(
				'class' => 'KB_404_Document',
				'file'  => get_theme_file_path( 'document-types/404.php' ),
			);
		}

		/**
		 * Is current structure could be outputed as location
		 *
		 * @return boolean
		 */
		public function is_location() {
			return true;
		}

		/**
		 * Location name
		 *
		 * @return boolean
		 */
		public function location_name() {
			return 'kb_404';
		}

		/**
		 * Aproprite location name from Elementor Pro
		 * @return [type] [description]
		 */
		public function pro_location_mapping() {
			return '404';
		}

	}

}
